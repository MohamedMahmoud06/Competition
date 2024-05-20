const serverResponse = {
    superadmin: {
        email: 'superadmin@gmail.com',
        pass: 'superadminpass'
    },
    member: {
        email: 'member@example.com',
        pass: 'memberpass'
    }
};

function signIn(email, pass, userType) {
    if (email === serverResponse.superadmin.email && pass === serverResponse.superadmin.pass) {
        return userType === 'superadmin' ? 'games.php' : 'Invalid user type';
    } else if (email === serverResponse.member.email && pass === serverResponse.member.pass) {
        return userType === 'member' ? 'home.php' : 'Invalid user type';
    } else {
        return 'User not found';
    }
}

function testSignIn() {
    let result = signIn('superadmin@gmail.com', 'superadminpass', 'superadmin');
    console.assert(result === 'games.php', 'Test case 1 failed');

    result = signIn('member@example.com', 'memberpass', 'member');
    console.assert(result === 'home.php', 'Test case 2 failed');

    result = signIn('superadmin@gmail.com', 'wrongpass', 'superadmin');
    console.assert(result === 'Invalid user type', 'Test case 3 failed');

    result = signIn('member@example.com', 'wrongpass', 'member');
    console.assert(result === 'Invalid user type', 'Test case 4 failed');

    result = signIn('unknown@example.com', 'unknownpass', 'member');
    console.assert(result === 'User not found', 'Test case 5 failed');

}

testSignIn();
