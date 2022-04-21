<div id="app" style="max-width: 414px; height: 100%; background-color: #f7f7f7; padding: 25px; margin: auto;">
    <h2 class="text-center">Gymnastick It</h2>
    <div v-if="status == 'HOME'">
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

        <br>
        <br>

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

        <label style="margin-right: 10px;" for="level5">5<br/>
            <input type="radio" id="level5" name="level" value="5" v-model="level">
        </label>

        <br>
        <br>

        <h4>Players</h4>

        <div class="input-group mb-3">
            <input v-if="players.length < 6" v-on:keyup.enter="addPlayer" name="players" v-model="player_name" type="text" class="form-control" placeholder="Player name" autocomplete="off">
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
                <h2 style="margin-top: -14px;">{{ round_index }}</h2>
            </div>
            <div class="col text-center">
                <h4>Skill</h4>
                <p>{{ skill }}</p>
            </div>
        </div>

        <h2 class="text-center">{{ players[player_index].name }}</h2>

        <br>

        <div class="text-center">
            <input
                @click="stick"
                type="radio"
                class="btn-check"
                name="stick-options"
                id="stick"
                autocomplete="off"
                :checked="isButtonChecked(2)">
            <label style="width: 250px; margin-bottom: 10px;" class="btn btn-outline-success btn-lg" for="stick">Stick</label>
        </div>

        <div class="text-center">
            <input
                @click="step"
                type="radio"
                class="btn-check"
                name="stick-options"
                id="step"
                autocomplete="off"
                :checked="isButtonChecked(1)">
            <label style="width: 250px; margin-bottom: 10px;" class="btn btn-outline-warning btn-lg" for="step">Step</label>
        </div>

        <div class="text-center">
            <input
                @click="nope"
                type="radio"
                class="btn-check"
                name="stick-options"
                id="nope" autocomplete="off"
                :checked="isButtonChecked(0)">
            <label style="width: 250px;" class="btn btn-outline-danger btn-lg" for="nope">Nope</label>
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
            error: ''
        },

        methods: {
            addPlayer: function () {
                if (this.player_name === '') {
                    this.player_name = 'Player ' + (this.players.length + 1);
                    // this.error = 'Missing player name';
                    // return;
                }

                player = {
                    name: this.player_name,
                    scores: {},
                    result: 0
                };

                this.players.push(player);
                //this.player_name = 'Player ' + (this.players.length + 1);
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

                // TODO reset score
            },

            calculateScore: function () {
                for (let i = 0; i < this.players.length; i++) {
                    var score = 0;

                    for (let j = 1; j <= this.rounds; j++) {
                        score = score + this.players[i].scores[j];
                    }

                    this.players[i].result = score;
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
                var direct = direction[Math.floor(Math.random() * direction.length)];

                switch(this.level) {
                    case '1':
                        var skill = tramp1[Math.floor(Math.random() * tramp1.length)];
                        break;
                    case '2':
                        var skill = tramp2[Math.floor(Math.random() * tramp2.length)];
                        break;
                    case '3':
                        var skill = tramp3[Math.floor(Math.random() * tramp3.length)];
                        break;
                    case '4':
                        var skill = tramp4[Math.floor(Math.random() * tramp4.length)];
                        break;
                    case '5':
                        var skill = tramp5[Math.floor(Math.random() * tramp5.length)];
                        break;
                }

                this.skill = skill;
                // this.skill = direct.concat(' ', skill);
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
                this.next();
            },

            isButtonChecked: function (score) {
                if (this.players[this.player_index].scores[this.round_index] == score) {
                    return true;
                }

                return false;
            }
        }
    });

    var tramp1 = ['Lukket Salto','Hofte Salto','Strakt Salto','Lukket 1/2 Skrue',
                'Hofte 1/2 Skrue','Strakt 1/2 Skrue','Lukket Hel Skrue','Strakt Hel Skrue',
                '1 1,2 Skrue','1 1,2 Skrue','Double Skrue','Double Skrue','2 1/2 Skrue',
                '2 1/2 Skrue','Molberg / Tysker','Molberg / Tysker'
    ];

    var tramp2 = ['Lukket Salto','Hofte Salto','Lukket Hel skrue','Double Hofte','Double Strakt',
                'Double Skrue','Tripple Skrue','Full Half','Half Full','2,5 Skrue','1,5 Skrue','Double Out',
                'Hofte Out','Half In','Half In Half Out','Full In','Full In Hofte','3,5 Skrue','Rudy Out',
                'Rudy In','Hofte Full Out','Molberg / Tysker','Molberg  1/2 Skrue','Molberg Hel Skrue',
                'Tysker 1/2 Skrue','Tysker Hel Skrue', '1/2 Skrue','Strakt Full Out','Strakt Full In',
                'Full Full','Strakt Full Full','Double Strakt 1 1/2 Skrue','Double Strakt 2 Skruer',
                'Double lukket hel Skrue','Double lukket 1/2 Skrue','Double lukket 1 1/2 Skrue',
                'Double lukket 2 Skruer','Double Hoft 1/2 Skrue','Double Hoft hel Skrue','Double Hoft 1 1/2 Skrue'
    ];

    var tramp3 = ['Double Hofte','Double Strakt','Double Skrue','Tripple Skrue','Tripple Lukket',
                'Full Half','Half Full','2,5 Skrue','1,5 Skrue','Double Out','Hofte Out','Half In',
                'Half In Half Out', 'Full In','Full In Hofte','3,5 Skrue','Rudy Out','Rudy In','Tripple Out',
                'Tripple Hofte', 'Hofte Full Out','Molberg / Tysker','Molberg  1/2 Skrue','Molberg Hel Skrue',
                'Tysker 1/2 Skrue', 'Tysker Hel Skrue','Strakt Full Out','Strakt Full In','Full Full',
                'Strakt Full Full', 'Miller','Strakt Miller','Double Strakt 1,5 Skrue','Double Strakt 2,5 Skrue',
                'Double Strakt 3,5 Skrue','4 Skruer','4,5 Skrue', 'Lukket Rudy Out', 'Double lukket', 'Hofte Half In',
                'Lukket Full Rudy', 'Lukket Miller', 'Strakt Full Rudy'
    ];

    var tramp4 = ['Double Hofte','Double Strakt','Double Skrue','Tripple Skrue','Tripple Lukket','Full Half',
                'Half Full','2,5 Skrue','1,5 Skrue','Double Out','Hofte Out','Half In','Half In Half Out',
                'Full In','Full In Hofte','3,5 Skrue','Rudy Out','Rudy In','Tripple Out','Tripple Hofte',
                'Hofte Full Out','Molberg / Tysker','Molberg  1/2 Skrue','Molberg Hel Skrue','Tysker 1/2 Skrue',
                'Tysker Hel Skrue', '1/2 Skrue','Strakt Full Out','Strakt Full In','Full Full','Strakt Full Full',
                'Miller','Strakt Miller','Double Strakt 1,5 Skrue','Double Strakt 2,5 Skrue',
                'Double Strakt 3,5 Skrue','4 Skruer','4,5 Skrue','5 Skruer','Tripple 1,5 Skrue','Tripple 2,5 Skrue',
                'Tripple Hel Skrue','Killer','Double 5 Skruer','Quad','Quad Out','Tripple Rudy Out','Half In Triff',
                'Half In Half Out Triff','Front Full Half','Half In the middle Triff','Randy Out','Addy Out',
                'Hofte Randy Out','Hofte Addy Out','Tripple lukket Rudy Out','Half In Full Out Triff',
                'Full In Triff Hofte','Tripple Strakt','Double Strakt 4,5 Skrue',' Double Molberg','Double Tysker',
                'Full Full Full','Hafl Half Half','Full Half Back','Full In Half Out Triff','Hofte In Half In',
                'Lukket In Half In','Valgfri Tripple','Valgfri Double','Valgfri Quad'
    ];

    var tramp5 = [
        'Double Front Tuck', 'Double Back Tuck', 'Barani in', 'Front Rudy', 'Back Full', 'Front Full', 'Gainer Tuck'
    ];

    var direction = ['Front', 'Back'];

</script>