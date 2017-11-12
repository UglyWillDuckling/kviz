
const state = {
    question: {
        id: 1,
        body: 'my first question is: did you know, we put a man on the moon.',
        image: false,
        video: false,
        multipart: false,
        answerType: 'text',
        numberOfAnswers: 4,
        numberOfCorrectAnswers: 1,
    },
    answers: [
        {
            id: 2,
            content: 'Lajka'
        },
        {
            id: 3,
            content: 'Sajka'
        },
        {
            id: 4,
            content: 'Balalajka'
        },
        {
            id: 5,
            content: 'Pomajka'
        },
    ],
     subquestions: [

     ]
}
const getters = {
    question: state => state.question,
    answers: state => state.answers,
    subquestions: state => state.subquestions
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
        replaceQuestion: (state,question) => {
            state.question = question;
        }
    }
}