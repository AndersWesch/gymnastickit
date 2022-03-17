<div id="app" class="row" style="margin: 50px;">
    <div class="col-md-5">
        <h4 class="text-center">Trampoline Picker</h4>

        <table class="table">
            <tr>
                <th>Level 1</th>
                <th>Level 2</th>
                <th>Level 3</th>
                <th>Level 4</th>
            </tr>
            <tr>
                <th><input type="radio" value="1" v-model="trampLevel"></th>
                <th><input type="radio" value="2" v-model="trampLevel"></th>
                <th><input type="radio" value="3" v-model="trampLevel"></th>
                <th><input type="radio" value="4" v-model="trampLevel"></th>
            </tr>
        </table>

        <pre> {{ trampSkill }}</pre>
        <div class="text-center">
            <button class="btn btn-primary" @click="trampPicker1" v-if="trampLevel == 1">Next Skill</button>
            <button class="btn btn-primary" @click="trampPicker2" v-if="trampLevel == 2">Next Skill</button>
            <button class="btn btn-primary" @click="trampPicker3" v-if="trampLevel == 3">Next Skill</button>
            <button class="btn btn-primary" @click="trampPicker4" v-if="trampLevel == 4">Next Skill</button>
        </div>
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-6">
        <h4 class="text-center">Tumbling Picker</h4>

        <table class="table">
            <tr>
                <th>Level 1</th>
                <th>Level 2</th>
                <th>Level 3</th>
                <th>Level 4</th>
            </tr>
            <tr>
                <th><input type="radio" value="1" v-model="tumblingLevel"></th>
                <th><input type="radio" value="2" v-model="tumblingLevel"></th>
                <th><input type="radio" value="3" v-model="tumblingLevel"></th>
                <th><input type="radio" value="4" v-model="tumblingLevel"></th>
            </tr>
        </table>

        <pre> {{ tumblingSkill }}</pre>
        <div class="text-center">
            <button class="btn btn-primary" @click="tumblingPicker1" v-if="tumblingLevel == 1">Next Skill</button>
            <button class="btn btn-primary" @click="tumblingPicker2" v-if="tumblingLevel == 2">Next Skill</button>
            <button class="btn btn-primary" @click="tumblingPicker3" v-if="tumblingLevel == 3">Next Skill</button>
            <button class="btn btn-primary" @click="tumblingPicker4" v-if="tumblingLevel == 4">Next Skill</button>
        </div>
    </div>
</div>

<!-- Vue.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.25/vue.min.js"></script>

<!-- Vue instance -->
<script>

    new Vue({
        el: '#app',
        data: {
            trampLevel: 1,
            tumblingLevel: 1,
            trampSkill: '',
            tumblingSkill: ''
        },

        methods: {
            trampPicker1: function () {
                var direct = direction[Math.floor(Math.random() * direction.length)];
                var skill = tramp1[Math.floor(Math.random() * tramp1.length)];
                this.trampSkill = direct.concat(' - ', skill);
            },

            trampPicker2: function () {
                var direct = direction[Math.floor(Math.random() * direction.length)];
                var skill = tramp2[Math.floor(Math.random() * tramp2.length)];
                this.trampSkill = direct.concat(' - ', skill);
            },

            trampPicker3: function () {
                var direct = direction[Math.floor(Math.random() * direction.length)];
                var skill = tramp3[Math.floor(Math.random() * tramp3.length)];
                this.trampSkill = direct.concat(' - ', skill);
            },

            trampPicker4: function () {
                var direct = direction[Math.floor(Math.random() * direction.length)];
                var skill = tramp4[Math.floor(Math.random() * tramp4.length)];
                this.trampSkill = direct.concat(' - ', skill);
            },

            tumblingPicker1: function () {
                this.tumblingSkill = tumbling1[Math.floor(Math.random() * tumbling1.length)];
            },

            tumblingPicker2: function () {
                this.tumblingSkill = tumbling2[Math.floor(Math.random() * tumbling2.length)];
            },

            tumblingPicker3: function () {
                this.tumblingSkill = tumbling3[Math.floor(Math.random() * tumbling3.length)];
            },

            tumblingPicker4: function () {
                this.tumblingSkill = tumbling4[Math.floor(Math.random() * tumbling4.length)];
            },
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

    var direction = ['Forlæns', 'Baglæns', 'Forlæns', 'Baglæns', 'Forlæns', 'Baglæns', 'Forlæns', 'Baglæns'];

    var tumbling1 = ['( ^ f -/', '( ^ ^ -/', '( ^ f -<', '( ^ ^ -<', '( ^ f -o', '( ^ ^ -o', '( ^ f 2/', '( ^ ^ 2/',
                '( ^ f 4/', '( ^ ^ 4/', '( ^ f --o', '( ^ ^ --o', '( ^ f 1/', '( ^ ^ 1/', '( ^ f 3/', '( ^ ^ 3/'
    ];

    var tumbling2 = ['( ^ f --o', '( ^ ^ --o', '( ^ f --<', '( ^ ^ --<', '( ^ f 2/', '( ^ ^ 2/', '( ^ f 4/', '( ^ ^ 4/',
                '( ^ f 6/', '( ^ ^ 6/', '( ^ f 2-o', '( ^ ^ 2-o', '( ^ f -2o', '( ^ ^ -2o', '( ^ f 22o', '( ^ ^ 22o'
    ];

    var tumbling3 = ['( ^ f --o', '( ^ ^ --o', '( ^ f --<', '( ^ ^ --<', '( ^ f --/', '( ^ ^ --/', '( ^ f 2-o', '( ^ ^ 2-o',
                '( ^ f -2o', '( ^ ^ -2o', '( ^ f 22o', '( ^ ^ 22o', '( ^ f 22/', '( ^ ^ 22/', '( ^ f -2/', '( ^ ^ -2/',
                '( ^ f 2-/', '( ^ ^ 2-/', '( ^ f 21o', '( ^ ^ 21o', '( ^ f 1-o', '( ^ ^ 1-o', '( ^ f 1-<', '( ^ ^ 1-<',
                '( ^ f -1/', '( ^ ^ -1/','( ^ f 33/', '( ^ ^ 33/', '( ^ f ---o', '( ^ ^ ---o', '( ^ f ---<', '( ^ ^ ---<',
                '( ^ f 23/', '( ^ ^ 23/', '( ^ f 23o', '( ^ ^ 23o'
    ];

    var tumbling4 = ['( ^ f --o', '( ^ ^ --o', '( ^ f --<', '( ^ ^ --<', '( ^ f --/', '( ^ ^ --/', '( ^ f 2-o', '( ^ ^ 2-o',
                '( ^ f -2o', '( ^ ^ -2o', '( ^ f 22o', '( ^ ^ 22o', '( ^ f 22/', '( ^ ^ 22/', '( ^ f -2/', '( ^ ^ -2/',
                '( ^ f 2-/', '( ^ ^ 2-/', '( ^ f 21o', '( ^ ^ 21o', '( ^ f 1-o', '( ^ ^ 1-o', '( ^ f 1-<', '( ^ ^ 1-<',
                '( ^ f -1/', '( ^ ^ -1/',

                '( ^ f 33/', '( ^ ^ 33/', '( ^ f ---o', '( ^ ^ ---o', '( ^ f ---<', '( ^ ^ ---<', '( ^ f 23/', '( ^ ^ 23/',
                '( ^ f 23o', '( ^ ^ 23o', '...  2--o', '...  44/',

                '( --/ ^ f --/', '( --/ ^ ^ --/', '( --/ ^ f 22/', '( --/ ^ ^ 22/', '( --/ ^ f 2-/',
                '( --/ ^ ^ 2-/', '( --/ ^ f 33/', '( --/ ^ ^ 33/', '( --/ ^ f ---o', '( --/ ^ ^ ---o', '( --/ ^ f 22o', '( --/ ^ ^ 22o',

                '( 2-/ ^ f --/', '( 2-/ ^ ^ --/', '( 2-/ ^ f 22/', '( 2-/ ^ ^ 22/', '( 2-/ ^ f 2-/',
                '( 2-/ ^ ^ 2-/', '( 2-/ ^ f 33/', '( 2-/ ^ ^ 33/', '( 2-/ ^ f ---o', '( 2-/ ^ ^ ---o', '( 2-/ ^ f 22o', '( 2-/ ^ ^ 22o',

                '( 22/ ^ f --/', '( 22/ ^ ^ --/', '( 22/ ^ f 22/', '( 22/ ^ ^ 22/', '( 22/ ^ f 2-/',
                '( 22/ ^ ^ 2-/', '( 22/ ^ f 33/', '( 22/ ^ ^ 33/', '( 22/ ^ f ---o', '( 22/ ^ ^ ---o', '( 22/ ^ f 22o', '( 22/ ^ ^ 22o'
    ];

</script>
