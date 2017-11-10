const state = {
    all: [
        {
            name: 'player1',
            id: 1
        },
        {
            name: 'player2',
            id: 2
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