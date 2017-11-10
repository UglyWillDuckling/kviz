
const state = {
    question: [
        {
            id: 1,
            body: 'my first question is: did you know, we put a man on the moon.',
            answers: {

            },
            multipart: false,
            numberOfAnswers: 4,
            numberOfCorrectAnswers: 1
        }
    ],

    answers: [
        {
            id: 1,
            text: 'Lajka'
        }

    ]

}

const getters = {
    question: state => state.question
}

const actions = {
    loadQuestion() {
        console.log('load the initial question from the server')
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations: {

    }
}