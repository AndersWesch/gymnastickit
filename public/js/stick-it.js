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
        level: '',
        level_trim: '',
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

            if (this.player_name.length >= 16) {
                this.error = 'Player name too long';
                return;
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
            if (this.players.length < 1) {
                this.error = 'Not enough players';
                return;
            }

            if (this.level == '') {
                this.error = 'No level selected';
                return;
            }

            this.level_trim =  this.level.toLowerCase();
            this.level_trim = this.level_trim.replace(/\s/g, '');

            if (!levels.includes(this.level_trim)) {
                this.error = 'Level not found';
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
            return eval(this.level_trim)[Math.floor(Math.random() * eval(this.level_trim).length)];
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
