<template>
    <div class="w-100 d-flex flex-column">
        <div><span>Comment</span></div>
        <div class="d-flex flex-row">
            <textarea v-model="body" class="form-control" placeholder="Enter comment"></textarea>
            <div class="d-flex flex-column">
                <button @click="saveComment" class="m-1 btn btn-success">comment</button>
                <button @click="clearComment" class="m-1 btn btn-danger">clear</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'new-comment',
        props: {
            user: {
                type: [Object, Boolean],
            },
        },
        methods: {
            saveComment: function () {
                let commentNew = {
                    user_id: this.user.id,
                    parrent_id: null,
                    body: this.body,
                };
                this.$emit('comment-create', commentNew);
                this.clearComment();
            },
            clearComment: function () {
                this.body = '';
            },
        },
        data: function () {
            return {
                body: '',
                comment: []
            }
        },
    }
</script>
