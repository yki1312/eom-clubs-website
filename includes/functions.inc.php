<?php
function emptyInputInvCode($invCode)
{
    return empty($invCode);
}
function invalidInvCode($invCode)
{
    $result = true; // preg_match() returns 1 or 0
    if (preg_match("/^[0-9]*$/", $invCode)) {
        $result = false;
        return $result;
    }
    return $result;
}
function invCodeExists($conn, $invCode)
{
    $invCodeExists = false;
    $sql = "SELECT invitationCodesID FROM invitationCodes WHERE invitationCodesID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../enterInvCode.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $invCode);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $invCodeExists = true;
    }

    mysqli_stmt_close($stmt);

    return $invCodeExists;
}
function usedInvCode($conn, $invCode)
{
    $usedInvCode = false;
    $sql = "SELECT usersInvCode FROM users WHERE usersInvCode = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../enterInvCode.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $invCode);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $usedInvCode = true;
    }

    mysqli_stmt_close($stmt);

    return $usedInvCode;
}
/* check if the inv code is expired
function expiredInvCode($conn, $invCode){
    $expiredInvCode = true;
    $sql = "SELECT invitationCodesCreationTime FROM invitationCodes WHERE invitationCodesID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../enterInvCode.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $invCode);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
    }

    mysqli_stmt_close($stmt);

    return $expiredInvCode;
}*/
function useInvCode($invCode)
{
    // is this the best method to pass on the inv code?
    header("location: ../createAccount.php?invCode=" . $invCode);
    exit();
}
function emptyInputSignup($uid, $pwd, $rePwd)
{
    return empty($uid) || empty($pwd) || empty($rePwd);
}
function invalidUID($uid)
{
    $result = true;
    if (preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        $result = true;
        return $result;
    }
    return $result;
}
function uidExists($conn, $uid)
{
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../createAccount.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $result = $row;
    }

    mysqli_stmt_close($stmt);

    if (!empty($result)) {
        return $result;
    }
    return false;
}
function pwdMatch($pwd, $rePwd)
{
    return $pwd === $rePwd;
}
//use trim($uid) to get rid of whitespace around passed in variable
function createUser($conn, $uid, $pwd, $invCode)
{
    $sql = "INSERT INTO users(usersUid, usersPwd, usersInvCode) VALUES(?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../createAccount.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssi", $uid, $hashedPwd, $invCode);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../createAccount.php?error=none");
    exit();
}
function emptyInputLogin($uid, $pwd)
{
    return empty($uid) || empty($pwd);
}
function loginUser($conn, $uid, $pwd)
{
    $uidExists = uidExists($conn, $uid);
    if ($uidExists === false) {
        header("location: ../login.php?error=nomatchinguid");
        exit();
    }
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    /*   if ($pwdHashed == $pwd) {
        $checkPwd = true;
    } else {
        $checkPwd = false;
    }
    */
    if ($checkPwd === false) {
        header("location: ../login.php?error=incorrectpwd");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userId"] = $uidExists["usersId"];
        $_SESSION["userUid"] = $uidExists["usersUid"];
        $userInvCode = $uidExists["usersInvCode"];
        $sql = "SELECT invitationCodesAccountType FROM invitationCodes WHERE invitationCodesID=$userInvCode;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["userRole"] = $row["invitationCodesAccountType"];
        }
        header("location: ../index.php");
        exit();
    }
}
