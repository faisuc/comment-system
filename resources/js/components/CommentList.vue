<template>
    <li :class="{ 'ml-10': comment.level == 2, 'ml-20': comment.level == 3 }">
        <div class="relative pb-8">
            <span
            class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
            aria-hidden="true"
            ></span>
            <div class="relative flex items-start space-x-3">
                <div class="relative">
                    <img
                    class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full ring-8 ring-white"
                    src="https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=8&amp;w=256&amp;h=256&amp;q=80"
                    alt=""
                    />

                    <span
                    class="absolute -bottom-0.5 -right-1 bg-white rounded-tl px-0.5 py-px"
                    >
                    <svg
                        class="w-5 h-5 text-gray-400"
                        x-description="Heroicon name: solid/chat-alt"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path
                        fill-rule="evenodd"
                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                        clip-rule="evenodd"
                        ></path>
                    </svg>
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-gray-900"
                            >{{ comment.name }}</a
                            >
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">Commented {{ comment.time_ago }}</p>
                    </div>
                    <div class="mt-2 text-sm text-gray-700">
                        <p>
                            {{ comment.comment }}
                        </p>
                        <button v-if="canReply" @click="setActiveComentReply(comment)" type="button" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-3">
                            Reply
                        </button>
                        <div v-if="showCommentForm" class="mt-10">
                            <comment-form :parentComment="comment" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative">
            <comment-list v-for="(reply, index) in comment.replies" :comment="reply" :key="index" />
        </div>
    </li>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex';
import CommentForm from './CommentForm.vue'
export default {
    name: 'comment-list',
    props: ['comment'],
    components: { CommentForm },
    methods: mapActions('comments', [
        'setActiveComentReply',
    ]),
    computed: {
        ...mapState({
            isReplyingToComment: state => state.comments.isReplyingToComment,
        }),
        showCommentForm: function () {
            return this.isReplyingToComment != null && this.isReplyingToComment.id == this.comment.id;
        },
        canReply: function () {
            return this.comment.level < 3;
        }
    }
}
</script>