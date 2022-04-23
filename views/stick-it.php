<div id="app" style="max-width: 414px; height: 100%; background-color: #f7f7f7; padding: 25px; margin: auto;">
    <h1 class="text-center">Gymnastick It</h1>
    <div v-if="status == 'HOME'">

        <br>

        <div class="row">
            <div class="col text-center">
                <h4>Rounds</h4>

                <label style="margin-right: 10px;" for="rounds1">3<br/>
                    <input type="radio" id="rounds1" name="rounds" value="3" v-model="rounds">
                </label>

                <label style="margin-right: 10px;" for="rounds2">5<br/>
                    <input type="radio" id="rounds2" name="rounds" value="5" v-model="rounds">
                </label>

                <label style="margin-right: 10px;" for="rounds3">7<br/>
                    <input type="radio" id="rounds3" name="rounds" value="7" v-model="rounds">
                </label>

                <label style="margin-right: 10px;" for="rounds4">10<br/>
                    <input type="radio" id="rounds4" name="rounds" value="10" v-model="rounds">
                </label>
            </div>
            <div class="col text-center">
                <h4>Level</h4>

                <label style="margin-right: 10px;" for="level1">1<br/>
                    <input type="radio" id="level1" name="level" value="1" v-model="level">
                </label>

                <label style="margin-right: 10px;" for="level2">2<br/>
                    <input type="radio" id="level2" name="level" value="2" v-model="level">
                </label>

                <label style="margin-right: 10px;" for="level3">3<br/>
                    <input type="radio" id="level3" name="level" value="3" v-model="level">
                </label>

                <label style="margin-right: 10px;" for="level4">4<br/>
                    <input type="radio" id="level4" name="level" value="4" v-model="level">
                </label>

                <label style="margin-right: 10px;" for="level5">A<br/>
                    <input type="radio" id="level5" name="level" value="5" v-model="level">
                </label>
            </div>
        </div>

        <br>

        <h4>Players</h4>

        <div class="input-group mb-3" v-if="players.length < 6">
            <input v-on:keyup.enter="addPlayer" name="players" v-model="player_name" type="text" class="form-control" placeholder="Player name" autocomplete="off">
            <div class="input-group-append">
                <button v-if="players.length < 6" @click="addPlayer" class="btn btn-outline-success" type="button">Add</button>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
          </thead>
          <tbody>
              <tr v-for="player in players">
                  <th>{{ $index+1 }}</th>
                  <th>{{ player.name }}</th>
                  <th><button @click="removePlayer($index)" class="btn btn-danger btn-sm">X</button></th>
              </tr>
          </tbody>
        </table>

        <div class="text-center">
            <button class="btn btn-success" :disabled="players.length < 2" @click="start">START</button>
        </div>

    </div>

    <div v-if="status == 'RUNNING'">
        <br>
        <div class="row">
            <div class="col text-center">
                <p>Round</p>
                <h1 style="margin-top: -14px;">{{ round_index }}</h2>
            </div>
            <div class="col text-center">
                <h4>Skill</h4>
                <p>{{ skill }}</p>
            </div>
        </div>

        <h2 class="text-center">{{ players[player_index].name }}</h2>

        <br>

        <div class="radios">
            <input
                @click="nextDelayed()"
                class="selected-green"
                type="radio"
                id="stickradio"
                value="2"
                name="stick"
                v-model="players[player_index].scores[round_index]">
            <label class="stick-green" for="stickradio">Stick</label>

            <input
                @click="nextDelayed()"
                class="selected-yellow"
                type="radio"
                id="stepradio"
                value="1"
                name="stick"
                v-model="players[player_index].scores[round_index]">
            <label class="stick-yellow" for="stepradio">Step</label>

            <input
                @click="nextDelayed()"
                class="selected-red"
                type="radio"
                id="noperadio"
                value="0"
                name="stick"
                v-model="players[player_index].scores[round_index]">
            <label class="stick-red" for="noperadio">Nope</label>
        </div>

        <br>
        <br>

        <div class="row">
            <div class="col text-start">
                <button class="btn btn-secondary" @click="back">Back</button>
            </div>
            <div class="col text-end">
                <button class="btn btn-secondary" @click="next">Next</button>
            </div>
        </div>
    </div>

    <div v-if="status == 'RESULT'">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Result</th>
                </tr>
          </thead>
          <tbody>
              <tr v-for="player in players">
                  <th>{{ $index+1 }}</th>
                  <th>{{ player.name }}</th>
                  <th>{{ player.result }}</th>
              </tr>
          </tbody>
        </table>

        <div class="row">
            <div class="col text-center">
                <button class="btn btn-secondary" @click="home">Home</button>
            </div>
            <div class="col text-center">
                <button class="btn btn-secondary" @click="playAgain">Play Again</button>
            </div>
        </div>
    </div>

    <div v-if="error != ''">
        <p class="text-center" style="color: #dc3545">{{ error }}</p>
    </div>
</div>

<!-- Vue.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.25/vue.min.js"></script>

<!-- Vue instance -->
<script>
    new Vue({
        el: '#app',
        data: {
            status: 'HOME',
            players: [],
            player_name: '',
            player_index: 0,
            rounds: 3,
            round_index: 1,
            skill: '',
            level: '1',
            error: '',
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

                this.round_index = 1;
                this.player_index = 0;
                this.setSkill();
                this.error = '';
                this.status = 'RUNNING';
                this.resetScores();
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
                        console.log(this.players);
                        return;
                    }

                    this.player_index = 0;
                    this.round_index++;
                    this.setSkill();
                } else {
                    this.player_index++;
                }
            },

            setSkill: function () {
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

                if (this.skill == skill) {
                    this.setSkill();
                    return;
                }

                this.skill = skill;
            },

            home: function () {
                this.status = 'HOME';
            },

            playAgain: function () {
                this.start();
            },

            stick: function () {
                this.setScore(2);
            },

            step: function () {
                this.setScore(1);
            },

            nope: function () {
                this.setScore(0);
            },

            setScore: function (score) {
                this.players[this.player_index].scores[this.round_index] = score;
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
</script>