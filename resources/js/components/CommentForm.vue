<template>
    <div class="flex space-x-3">
        <div class="flex-shrink-0">
            <div class="relative">
                <img
                class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full ring-8 ring-white"
                src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=8&amp;w=256&amp;h=256&amp;q=80"
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
        </div>
        <div class="flex-1 min-w-0">
            <form action="#">
                <div>
                    <input v-model="username" type="text" name="username" id="name" placeholder="Name" class="block w-full max-w-lg border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm">
                </div>
                <div class="mt-3">
                    <label for="comment" class="sr-only">Comment</label>
                    <textarea
                        v-model="comment"
                        id="comment"
                        name="comment"
                        rows="3"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                        :placeholder="`Leave a ${placeholderLabel}`"
                    ></textarea>
                </div>
                <div class="flex items-center justify-end mt-6 space-x-4">
                    <button
                        @click.prevent="store"
                        type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gray-900 border border-transparent rounded-md shadow-sm hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                    >
                        {{ placeholderLabel.toUpperCase() }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: [
        'parentComment',
    ],
    data: function () {
        return {
            username: '',
            comment: '',
        }
    },
    methods: {
        store: function () {
            let level = 1;
            let parent_id = null;
            
            if (this.parentComment != null) {
                parent_id = this.parentComment.id;
                if (this.parentComment.level == 1) {
                    level = 2;
                } else if (this.parentComment.level == 2) {
                    level = 3;
                } else {
                    level = 3;
                }
            }

            axios.post('api/comments', {
                name: this.username,
                comment: this.comment,
                level: level,
                parent_id: parent_id,
            })
            .then(response => {
                if (this.parentComment != null && typeof this.parentComment.replies == 'undefined') {
                    this.$set(this.parentComment, 'replies', []);
                }
                this.$store.commit('comments/newComment', { comment: response.data.data, parentComment: this.parentComment });
                this.$store.commit('comments/clearErrors');
                this.clearInputs();
            })
            .catch(error => {
                if (error.data != null) {
                    this.$store.commit('comments/addErrors', Object.values(error.data.errors).flat(2));
                } else {
                    console.log(error);
                }
            });
        },
        clearInputs: function () {
            this.username = '';
            this.comment = '';
        }
    },
    computed: {
        placeholderLabel: function () {
            let label = 'comment';

            if (this.parentComment != null) {
                label = 'reply';
            }

            return label;
        }
    }
}
</script>