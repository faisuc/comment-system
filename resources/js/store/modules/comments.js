const state = () => ({
    all: [],
    newComment: null,
    isReplyingToComment: null,
    errors: [],
});

const getters = {
    isReplying: state => {
        return state.isReplyingToComment ? true : false;
    }
};

const actions = {
    getAllComments ({ commit }) {
        axios.get('api/comments')
            .then(response => {
                commit('loadComments', response.data.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    setActiveComentReply ({ commit }, comment) {
        commit('willReplyToComment', comment);
    }
}

const mutations = {
    loadComments (state, comments) {
        state.all = comments;
    },
    newComment (state, { comment, parentComment }) {
        if (parentComment != null) {
            parentComment.replies.push(comment);
        } else {
            state.all.unshift(comment);
        }
    },
    addErrors (state, errors) {
        state.errors = errors;
    },
    clearErrors (state) {
        state.errors = [];
    },
    willReplyToComment (state, comment) {
        state.isReplyingToComment = comment;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};