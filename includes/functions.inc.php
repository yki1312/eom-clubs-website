<?php
function emptyInputInvCode($invCode)
{
    return empty($invCode);
}
function invalidInvCode($invCode)
{
    // preg_match() returns 1 or 0
    $result = true;
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
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../enterInvCode.php?error=exefailed");
        exit();
    }
    $resultData = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($resultData)) {
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
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../enterInvCode.php?error=exefailed");
        exit();
    }
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $usedInvCode = true;
    }
    mysqli_stmt_close($stmt);
    return $usedInvCode;
}
function invCodeCreationTime($conn, $invCode)
{
    $sql = "SELECT invitationCodesCreationTime FROM invitationCodes WHERE invitationCodesID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../enterInvCode.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $invCode);
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../enterInvCode.php?error=exefailed");
        exit();
    }
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $creationTime = $row["invitationCodesCreationTime"];
    } else {
        header("location: ../enterInvCode.php?error=queryfailed");
        exit();
    }
    mysqli_stmt_close($stmt);
    return $creationTime;
}
function expiredInvCode($conn, $creationTime)
{
    $now = time();
    $creation = strtotime($creationTime);
    $diff = $now - $creation;
    //seconds in a day
    if ($diff <= 86400) {
        return false;
    }
    return true;
}
function validInvCode($invCode)
{
    header("location: ../createAccount.php?invCode=" . $invCode);
    exit();
}
function emptyInputSignup($uid, $pwd, $rePwd, $invCode)
{
    return empty($uid) || empty($pwd) || empty($rePwd) || empty($invCode);
}
function uidExists($conn, $uid, $isLogin)
{
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        if ($isLogin) {
            header("location: ../login.php?error=stmtfailed");
        }
        header("location: ../createAccount.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $uid);
    if (!mysqli_stmt_execute($stmt)) {
        if ($isLogin) {
            header("location: ../login.php?error=exefailed");
        }
        header("location: ../createAccount.php?error=exefailed");
        exit();
    }
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
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../createAccount.php?error=exefailed");
        //&uid=" . $uid . "&invCode=" . $invCode . "&pwd=" . $hashedPwd
        exit();
    };
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
    $uidExists = uidExists($conn, $uid, true);
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
        $_SESSION["userId"] = $uidExists["usersID"];
        $_SESSION["userUid"] = $uidExists["usersUid"];
        $userInvCode = $uidExists["usersInvCode"];
        $sql = "SELECT invitationCodesAccountType FROM invitationCodes WHERE invitationCodesID=$userInvCode;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["userRole"] = $row["invitationCodesAccountType"];
        }
        header("location: ../main_page.php");
        exit();
    }
}
function emptyInputClubPage($id, $title)
{
    return empty($id) || empty($title);
}
function updateClubPage($conn, $id, $title, $description, $contact)
{
    $sql = "UPDATE clubs SET clubsTitle=?, clubsDescription=?, clubsContactInfo=? WHERE clubsID=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $contact, $id);
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=exefailed");
        exit();
    };
    mysqli_stmt_close($stmt);
    header("location: ../clubPageUser.php?club=" . $id . "&error=none#basicInfo");
    exit();
}
function deleteClubMedia($conn, $id)
{
    $sql = "SELECT clubsMedia FROM clubs WHERE clubsID=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return false;
    }
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $path = "../img/" . $row["clubsMedia"];
        mysqli_stmt_close($stmt);
        unlink($path);
        return true;
    }
    mysqli_stmt_close($stmt);
    return false;
}
function updateClubMedia($conn, $id, $media)
{
    $sql = "UPDATE clubs SET clubsMedia=? WHERE clubsID=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "si", $media, $id);
    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return false;
    };
    mysqli_stmt_close($stmt);
    return true;
}
function deleteClubPage($conn, $id)
{
    $sql2 = "DELETE FROM clubSuggestions WHERE clubSuggestionsClub=?;";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=stmt2failed#basicInfo");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, "i", $id);
    if (!mysqli_stmt_execute($stmt2)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=exe2failed#basicInfo");
        exit();
    };
    mysqli_stmt_close($stmt2);

    $sql3 = "DELETE FROM clubMembers WHERE clubMembersClub=?;";
    $stmt3 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt3, $sql3)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=stmt3failed#basicInfo");
        exit();
    }
    mysqli_stmt_bind_param($stmt3, "i", $id);
    if (!mysqli_stmt_execute($stmt3)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=exe3failed#basicInfo");
        exit();
    };
    mysqli_stmt_close($stmt3);

    if (deleteClubMedia($conn, $id) !== true) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=errordeletingmedia#basicInfo");
        exit();
    }

    $sql1 = "DELETE FROM clubs WHERE clubsID=?;";
    $stmt1 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt1, $sql1)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=stmt1failed#basicInfo");
        exit();
    }
    mysqli_stmt_bind_param($stmt1, "i", $id);
    if (!mysqli_stmt_execute($stmt1)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=exe1failed#basicInfo");
        exit();
    };
    mysqli_stmt_close($stmt1);

    header("location: ../main_page.php?error=none");
    exit();
}
function deleteSuggestion($conn, $suggestionID, $clubID)
{
    $sql = "DELETE FROM clubSuggestions WHERE clubSuggestionsID=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../clubPageUser.php?club=" . $clubID . "&error=stmt4failed#suggestionAndMember");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $suggestionID);
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../clubPageUser.php?club=" . $clubID . "&error=exe4failed#suggestionAndMember");
        exit();
    };
    mysqli_stmt_close($stmt);
    header("location: ../clubPageUser.php?club=" . $clubID . "&error=none1#suggestionAndMember");
    exit();
}
function addMember($conn, $name, $id)
{
    $sql = "INSERT INTO clubMembers(clubMembersName, clubMembersClub) VALUES(?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=stmt5failed#suggestionAndMember");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "si", $name, $id);
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=exe5failed#suggestionAndMember");
        exit();
    };
    mysqli_stmt_close($stmt);
    header("location: ../clubPageUser.php?club=" . $id . "&error=none2#suggestionAndMember");
    exit();
}
function deleteMember($conn, $memberID, $clubID)
{
    $sql = "DELETE FROM clubMembers WHERE clubMembersID=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../clubPageUser.php?club=" . $clubID . "&error=stmt6failed#suggestionAndMember");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $memberID);
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../clubPageUser.php?club=" . $clubID . "&error=exe6failed#suggestionAndMember");
        exit();
    };
    mysqli_stmt_close($stmt);
    header("location: ../clubPageUser.php?club=" . $clubID . "&error=none3#suggestionAndMember");
    exit();
}
function verifyPwd($conn, $uid, $pwd)
{
    $uidExists = uidExists($conn, $uid, false);
    if ($uidExists === false) {
        header("location: ../changePwd.php?error=nomatchinguid");
        exit();
    }
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if ($checkPwd === true) {
        return true;
    }
    return false;
}
function changePwd($conn, $uid, $newPwd)
{
    $sql = "UPDATE users SET usersPwd = ? WHERE usersUid = ?;";
    $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../changePwd.php?error=stmt7failed#media");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $uid);
    if (!mysqli_stmt_execute($stmt)) {
        header("location: ../changePwd.php?error=exe7failed#media");
        exit();
    };
    mysqli_stmt_close($stmt);
    header("location: ../userProfile.php?error=none");
    exit();
}
