<div id="stickit" class="page-div">

    <h1 class="text-center"><a href="/"><span style="color: #2f7dde">gymna</span><span style="color: #de2f2f">Stick It</span></a></h1>

    <div v-if="status == 'HOME'" style="margin-top: 15px;">
        <div class="row">
            <div class="col text-center">
                <h4>Rounds</h4>

                <label style="margin-right: 10px;" for="rounds1">3<br/>
                    <input :disabled="adventure_mode" type="radio" id="rounds1" name="rounds" value="3" v-model="rounds">
                </label>

                <label style="margin-right: 10px;" for="rounds2">5<br/>
                    <input :disabled="adventure_mode" type="radio" id="rounds2" name="rounds" value="5" v-model="rounds">
                </label>

                <label style="margin-right: 10px;" for="rounds3">7<br/>
                    <input :disabled="adventure_mode" type="radio" id="rounds3" name="rounds" value="7" v-model="rounds">
                </label>

                <label style="margin-right: 10px;" for="rounds4">10<br/>
                    <input :disabled="adventure_mode" type="radio" id="rounds4" name="rounds" value="10" v-model="rounds">
                </label>
            </div>
            <div class="col text-center">
                <h4>Level</h4>
                <input list="levels" type="text" autocomplete="off" name="level" placeholder="Level" class="form-control" v-model="level" style="margin-top: 13px;">

                <datalist id="levels">
                    <option value="level 1">
                    <option value="level 2">
                    <option value="level 3">
                    <option value="level 4">
                </datalist>
            </div>
        </div>

        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col" style="padding-top: 6px">
                <input type="checkbox" name="hard_mode" v-model="hard_mode" @click="setAlegria">
                <label>Hard Mode</label>
            </div>

            <div class="col" style="padding-top: 6px">
                <input type="checkbox" name="adventure_mode" v-model="adventure_mode" @click="setAdventureLevel()">
                <label>Adventure Mode</label>
            </div>
        </div>

        <h4>Players</h4>

        <div class="input-group mb-3" v-if="players.length < 10">
            <input v-on:keyup.enter="addPlayer" name="players" v-model="player_name" type="text" class="form-control" placeholder="Player name" autocomplete="off">
            <div class="input-group-append">
                <button v-if="players.length < 10" @click="addPlayer" class="btn btn-outline-success" type="button">Add</button>
            </div>
        </div>

        <div>
            <table class="my-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col"></th>
                    </tr>
              </thead>
              <tbody>
                  <tr v-for="player in players">
                      <td>{{ $index+1 }}</td>
                      <td>{{ player.name }}</td>
                      <td><button @click="removePlayer($index)" class="btn btn-danger btn-sm remove-player-btn">X</button></td>
                  </tr>
              </tbody>
            </table>
        </div>

        <div class="text-center" style="margin-top: 15px;">
            <button class="btn btn-success" :disabled="players.length < 1" @click="start">START</button>
        </div>
    </div>

    <div v-if="status == 'START_ADVENTURE'" style="margin-top: 15px;">
        <label>Start round</label>
        <input type="number" name="start_round" class="form-control" v-model="start_round">

        <br>

        <div class="row">
            <div class="col text-start">
                <button class="btn btn-secondary" @click="home">Back</button>
            </div>
            <div class="col text-end">
                <button class="btn btn-success" @click="startGame">Start</button>
            </div>
        </div>
    </div>

    <div v-if="status == 'SKILLSET'" style="margin-top: 15px;">
        <table class="my-table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Round</th>
                    <th scope="col">Skill</th>
                </tr>
          </thead>
          <tbody>
              <tr v-for="skill in round_skills">
                  <td class="text-center">{{ $index+1 }}</td>
                  <td>{{ skill }}</td>
              </tr>
          </tbody>
        </table>

        <div class="text-center" style="margin-top: 20px;">
            <button class="btn btn-outline-secondary" @click="setRoundSkills()">Shuffle</button>
        </div>

        <br>

        <div class="row">
            <div class="col text-start">
                <button class="btn btn-secondary" @click="home">Back</button>
            </div>
            <div class="col text-end">
                <button class="btn btn-success" @click="startGame">Start</button>
            </div>
        </div>
    </div>

    <div v-if="status == 'RUNNING'" style="margin-top: 15px;">
        <div class="row">
            <div class="col text-center">
                <p>Round</p>
                <h1 style="margin-top: -14px;">{{ round_index }}</h2>
            </div>
            <div class="col text-center">
                <h4>Skill</h4>
                <p>{{ round_skills[round_index-1] }}</p>
            </div>
        </div>

        <h2 class="text-center">{{ players[player_index].name }}</h2>
        <p class="text-center" style="margin-bottom: 0px; margin-top: -10px; font-size: 13px;">Score: {{ getPlayerScore() }}</p>

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
                value="{{ nope_value }}"
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
            <div class="col text-center" v-if="adventure_mode && player_index == 0">
                <button class="btn btn-outline-dark" @click="finishAdventure">Finish</button>
            </div>
            <div class="col text-end">
                <button class="btn btn-secondary" @click="next()">Next</button>
            </div>
        </div>
    </div>

    <div v-if="status == 'RESULT'" style="margin-top: 15px;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Result</th>
                    <th scope="col">Stats</th>
                </tr>
          </thead>
          <tbody>
              <tr v-for="player in players">
                  <td>{{ $index+1 }}</td>
                  <td>{{ player.name }}</td>
                  <td>{{ player.result }}</td>
                  <td>
                      <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" :style="'width: ' + (player.sticks/rounds) * 100 + '%'"></div>
                        <div class="progress-bar bg-warning" role="progressbar" :style="'width: ' + (player.steps/rounds) * 100 + '%'"></div>
                        <div class="progress-bar bg-danger" role="progressbar" :style="'width: ' + (player.nopes/rounds) * 100 + '%'"></div>
                    </div>
                  </td>
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

    <footer v-if="status == 'HOME' && players.length < 6" class="footer" style="position: fixed; bottom: 25px; width: 87%">
        <?php include('components/footer.php'); ?>
    </footer>

    <footer v-if="status == 'HOME' && players.length >= 6" style="padding-bottom: 10px; padding-top: 10px;">
        <?php include('components/footer.php'); ?>
    </footer>
</div>
