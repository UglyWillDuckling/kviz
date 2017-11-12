import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import players from './modules/players'
import question from './modules/question'

export default new Vuex.Store({
    state: {
        igraci: [
            {
                name: 'player1', id: 1
            },
            {
                name: 'player2', id: 3
            },
            {
                name: 'player3', id: 4
            },
            {
                name: 'player4', id: 5
            },
        ]
    },
    modules: {
        players,
        question
    }
})