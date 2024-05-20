function signUp(userId, gameId, userName, gameName, gamesCount) {
    // Mocking database queries and responses
    const mockResults = {
        userFound: true,
        alreadySignedUp: false,
        maxGamesLimitReached: false,
        success: true
    };

    // Check if user is found
    if (!mockResults.userFound) {
        return 'User not found';
    }

    // Check if user is already signed up for the game
    if (mockResults.alreadySignedUp) {
        return 'You are already signed up for this game!';
    }

    // Check if user has reached the maximum games limit
    if (gamesCount >= 5) {
        return 'Maximum games limit (5) reached!';
    }

    // Otherwise, simulate successful sign-up
    return 'Signup successful!';
}

// Define unit tests using Mocha and Chai
describe('Sign-Up Tests', function() {
    it('should return "User not found" if user is not found', function() {
        chai.expect(signUp('nonexistentUserId', 'gameId', 'userName', 'gameName', 0)).to.equal('User not found');
    });

    it('should return "You are already signed up for this game!" if user is already signed up', function() {
        chai.expect(signUp('existingUserId', 'existingGameId', 'userName', 'gameName', 0)).to.equal('You are already signed up for this game!');
    });

    it('should return "Maximum games limit (5) reached!" if user has reached max games limit', function() {
        chai.expect(signUp('userId', 'gameId', 'userName', 'gameName', 5)).to.equal('Maximum games limit (5) reached!');
    });

    it('should return "Signup successful!" for successful sign-up', function() {
        chai.expect(signUp('userId', 'gameId', 'userName', 'gameName', 4)).to.equal('Signup successful!');
    });
});
mocha.setup('bdd');
        mocha.run();