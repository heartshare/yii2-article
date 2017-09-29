window.yii.article = (function ($) {
    var pub = {
        // whether this module is currently active. If false, init() will not be called for this module
        // it will also not be called for all its child modules. If this property is undefined, it means true.
        isActive: true,
        init: function () {
            console.info('init article.');
            $(".article-comment-btn").click(function () {
                var id = $(this).data('id');
                var to_user_id = $(this).data('to_user_id');
                var content = $("#comment-" + "content-" + id).val();
                pub.add_comment(id, content, to_user_id);
                $("#comment-content-" + id + "").val('');
            });
        },

        /**
         * 发布评论
         * @param id
         * @param content
         * @param to_user_id
         */
        add_comment: function (id, content, to_user_id) {
            var postData = {id: id, content: content};
            if (to_user_id > 0) {
                postData.to_user_id = to_user_id;
            }
            $.post('/article/comment/create', postData, function (html) {
                $("#comments-" + id + " .widget-comment-list").append(html);
                $("#comment-" + "content-" + id).val('');
            });
        },

        /**
         * 清除评论
         * @param id
         */
        clear_comments: function (id) {
            $("#comments-" + id + " .widget-comment-list").empty();
        },


        load_comments: function (id) {
            $.get('/article/comment/index', {id: id}, function (html) {
                $("#comments-" + id + " .widget-comment-list").append(html);
            });
        }
    };
    return pub;
})(window.jQuery);