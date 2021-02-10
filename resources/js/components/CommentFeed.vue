<template>
    <div>
        <div v-if="errors.length > 0" class="p-4 rounded-md bg-red-50">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    </div>
                    <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        There were {{ errors.length }} error{{ errors.length > 1 ? 's' : '' }} with your submission
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="pl-5 space-y-1 list-disc">
                            <li v-for="(error, index) in errors" :key="index">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="flow-root">
            <template v-if="comments.length == 0">
                There are no comments yet.
            </template>
            <ul class="-mb-8">
                <comment-list v-for="(comment, index) in comments" :comment="comment" :key="index" />
            </ul>
        </div>
        <div class="mt-20">
            <comment-form />
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import CommentForm from './CommentForm.vue';
import CommentList from './CommentList.vue';
export default {
    components: {
        CommentForm,
        CommentList
    },
    computed: {
        ...mapState({
            comments: state => state.comments.all,
            newComment: state => state.comments.newComment,
            errors: state => state.comments.errors,
        }),
    },
    created () {
        this.$store.dispatch('comments/getAllComments');
    },
    watch: {
        newComment(newValue, oldValue) {
            console.log(newValue);
        }
    }
}
</script>