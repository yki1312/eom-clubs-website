<?php
function emptyInputInvCode($invCode)
{
    return empty($invCode);
}
function invalidInvCode($invCode)
{
    $result = true;
    if (!preg_match("/^[0-9]*$/", $invCode)) {
        $result = false;
        return $result;
    } else {
        return $result;
    }
}
function useInvCode($conn, $invCode)
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

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $invCodeExists = ($row["invitationCodesID"] === $invCode);
        }
    }

    mysqli_stmt_close($stmt);

    if ($invCodeExists === false) {
        header("location: ../enterInvCode.php?error=nomatchinginvcode");
        exit();
    } else if ($invCodeExists === true) {
        $_POST["invCode"] = $invCode;
        header("location: ../createAccount.php");
        exit();
    }
}
function emptyInputSignup($uid, $pwd, $rePwd)
{
    return empty($uid) || empty($pwd) || empty($rePwd);
}
function invalidUID($uid)
{
    $result = true;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        $result = false;
        return $result;
    } else {
        return $result;
    }
}
function uidExists($conn, $uid)
{
    $result = false;
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../createAccount.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function pwdMatch($pwd, $rePwd)
{
    $result = false;
    if ($pwd !== $rePwd) {
        $result = true;
        return $result;
    } else {
        return $result;
    }
}
function createUser($conn, $uid, $pwd, $invCode)
{
    $sql = "INSERT INTO users(usersUID, usersPwd, usersInvCode) VALUES(?, ?, ?);";
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
    $result = false;
    if (empty($uid) || empty($pwd)) {
        $result = true;
        return $result;
    } else {
        return $result;
    }
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
    if ($checkPwd === false) {
        header("location: ../login.php?error=incorrectpwd");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userId"] = $uidExists["usersId"];
        $_SESSION["userUid"] = $uidExists["usersUid"];
        $userInvCode = $uidExists["usersInVCode"];
        $sql = "SELECT invitationCodesAccountType FROM invitationCodes WHERE invitationCodesID=$userInvCode;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["userRole"] = $row["invitationCodesAccountType"];
            }
        }
        header("location: ../index.php");
        exit();
    }
}
