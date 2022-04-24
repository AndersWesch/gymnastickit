new Vue({
    el: '#stickit',
    data: {
        status: 'HOME',
        players: [],
        player_name: '',
        player_index: 0,
        rounds: 3,
        round_skills: [],
        round_index: 1,
        skill: '',
        level: '1',
        error: '',
        hard_mode: false,
        nope_value: 0
    },

    methods: {
        nextDelayed: function () {
            setTimeout(() => {
                this.next();
            }, 300);
        },

        isActive: function (score) {
            return this.players[this.player_index].scores[this.round_index] == score;
        },

        addPlayer: function () {
            if (this.player_name === '') {
                this.player_name = 'Player ' + (this.players.length + 1);
            }

            player = {
                name: this.player_name,
                scores: {},
                result: 0
            };

            this.players.push(player);
            this.player_name = '';
            this.error = '';
        },

        removePlayer: function (playerIndex) {
            this.players.splice(playerIndex, 1);
        },

        start: function () {
            if (this.players.length < 2) {
                this.error = 'Not enough players';
                return;
            }

            if (this.hard_mode) {
                this.nope_value = -1;
            } else {
                this.nope_value = 0;
            }

            this.round_index = 1;
            this.player_index = 0;
            this.setRoundSkills();
            this.error = '';
            this.status = 'SKILLSET';
            this.resetScores();
        },

        startGame: function () {
            this.status = 'RUNNING';
        },

        calculateScore: function () {
            for (let i = 0; i < this.players.length; i++) {
                var score = 0;

                for (let j = 1; j <= this.rounds; j++) {
                    score = score + parseInt(this.players[i].scores[j]);
                }

                this.players[i].result = score;
            }

            this.players.sort((a,b) => b.result - a.result);
        },

        resetScores: function () {
            for (let i = 0; i < this.players.length; i++) {
                this.players[i].scores = {};
            }

            // this.players[this.player_index].scores[this.round_index] = score;
        },

        back: function () {
            if (this.player_index <= 0) {
                if (this.round_index == 1) {
                    this.home();
                    return;
                }

                this.round_index--;
                this.player_index = this.players.length -1;
            } else {
                this.player_index--;
            }
        },

        next: function () {
            if (this.player_index === this.players.length - 1) {
                if (this.round_index >= this.rounds) {
                    this.status = 'RESULT';
                    this.calculateScore();
                    return;
                }

                this.player_index = 0;
                this.round_index++;
            } else {
                this.player_index++;
            }
        },

        setRoundSkills: function() {
            this.round_skills = [];

            for (let i = 0; i <= this.rounds-1; i++) {
                var skill = this.getSkill();

                while (this.round_skills.includes(skill)) {
                    skill = this.getSkill();
                }

                this.round_skills[i] = skill;
            }
        },

        getSkill: function () {
            switch(this.level) {
                case '1':
                    var skill = lvl1[Math.floor(Math.random() * lvl1.length)];
                    break;
                case '2':
                    var skill = lvl2[Math.floor(Math.random() * lvl2.length)];
                    break;
                case '3':
                    var skill = lvl3[Math.floor(Math.random() * lvl3.length)];
                    break;
                case '4':
                    var skill = lvl4[Math.floor(Math.random() * lvl4.length)];
                    break;
                case '5':
                    var skill = alegria[Math.floor(Math.random() * alegria.length)];
                    break;
            }

            return skill;
        },

        home: function () {
            this.status = 'HOME';
        },

        playAgain: function () {
            this.start();
        },

        isButtonChecked: function (score) {
            if (this.players[this.player_index].scores[this.round_index] == score) {
                return true;
            }

            return false;
        }
    }
});

var alegria = [
    'Double Front Tuck',
    'Double Front Pike',

    'Double Back Tuck',
    'Double Back Pike',

    'Barani In Tuck',
    'Barani In Pike',

    'Front Rudy',
    'Back Full',
    'Front Full',

    'Gainer Pike',
    'Gainer Full',
];

var lvl1 = [
    'Font: Tuck',
    'Font: Pike',
    'Font: Straight',

    'Back: Tuck',
    'Back: Pike',
    'Back: Straight',

    'Front: Barani',
    'Back: 1/2 Twist',

    'Back: Full Twist',
    'Front: Full Twist',
    'Front: Rudy'
];

var lvl2 = [
    'Front: Rudy',
    'Back: Rudy',

    'Front: Double Twist',
    'Back: Double Twist',

    'Front: Double Tuck',
    'Back: Double Tuck',

    'Front: Double Pike',
    'Back: Double Pike',

    'Front: Barani In Tuck',
    'Front: Double Out Tuck',

    'Front: Barani In Pike',
    'Front: Double Out Pike',
];

var lvl3 = [
    'Front: 2,5 Twist',
    'Back: 2,5 Twist',
    'Back: Tripple Twist',

    'Back: Double Tuck Half Out',
    'Back: Double Pike Half Out',
    'Back: Double Straight Half Out',

    'Front: Barani In Straight',
    'Front: Double Out Straight',

    'Front: Full In Tuck', // Full In
    'Back: Full In Tuck',
    'Front: Full In Pike',
    'Back: Full In Pike',
    'Back: Full In Straight',

    'Front: Double Tuck Full Out', // Full Out
    'Back: Double Tuck Full Out',
    'Front: Double Pike Full Out',
    'Back: Double Pike Full Out',
    'Back: Double Straight Full Out',

    'Front: Full Full Tuck', // Full Full
    'Back: Full Full Tuck',
    'Front: Full Full Straight',
    'Back: Full Full Straight',

    'Front: Full Half Tuck', // Full Half
    'Back: Full Half Tuck',
    'Front: Full Half Straight',
    'Back: Full Half Straight',

    'Front: Double Tuck Rudy Out', // Rudy Out
    'Front: Double Pike Rudy Out',
    'Front: Double Straight Rudy Out',

    'Front: Full Rudy Tuck',
    'Front: Full Rudy Straight',
];

var lvl4 = [
    'Back: Quadruple Twist',
    'Front: 3,5 Twist',

    'Front: Double Tuck Randy Out',
    'Front: Double Pike Randy Out',

    'Front: Rudy In Tuck',
    'Front: Rudy In Pike',

    'Back: Double Tuck Double Full Out',
    'Back: Double Straight Double Full Out',

    'Front: Full Full Tuck', // Full Full
    'Back: Full Full Tuck',
    'Front: Full Full Straight',
    'Back: Full Full Straight',

    'Front: Full Rudy Tuck', // Full Rudy
    'Front: Full Rudy Straight',
    'Back: Full Rudy Tuck',
    'Back: Full Rudy Straight',

    'Front: Miller Tuck', // Miller
    'Front: Miller Straight',
    'Back: Miller Tuck',
    'Back: Miller Straight',

    'Front: Double with 3,5 Twist Straight',
    'Front: Double with 3,5 Twist Tuck',
    'Back: Killer Straight',
    'Back: Killer Tuck',

    'Front: Tripple Tuck', // Tripples no twists
    'Back: Tripple Tuck',
    'Front: Tripple Pike',
    'Back: Tripple Pike',

    'Front: Tripple Out Tuck', // Tripples with twist
    'Front: Tripple Out Pike',

    'Front: Tripple Tuck Rudy Out',
    'Front: Tripple Pike Rudy Out',

    'Back: Full In Tripple Tuck',
    'Back: Full In Tripple Pike',

    'Front: Full Full Half',
    'Front: Front Full Half',
    'Front: Full Half Back',

    'Back: Full Full Full',
];