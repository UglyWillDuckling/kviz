const state = {
    all: [
        {
            nickname: 'player1',
            id: 1,
            active: true,
            correct: 0,
            wrong: 0
        },
        {
            nickname: 'player2',
            id: 2,
            active: true,
            correct: 0,
            wrong: 0
        },
    ]
}

const getters = {
    all: state => state.all
}

const actions = {}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations: {
        addPlayer: (state, player) => {
            state.all.push(player)
        }
    }
}