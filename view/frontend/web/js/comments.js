define([
    'jquery',
    'underscore',
    'mage/template',
    'text!Valerii_Comment/template/comment.html',
    'Magento_Ui/js/modal/modal'
], function ($, _, mageTemplate, commentTemplate) {
    'use strict';
    function processComments(url, fromPages)
    {
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
        }).done(function (data) {
            const items = data.items ?? null;
            if (items) {
                _.each(items, function (comment) {
                    const html = mageTemplate(commentTemplate)({
                        comment_id: comment.comment_id,
                        created_at: comment.created_at,
                        name: comment.name,
                        email: comment.email,
                        message: comment.message,
                    });
                    $('#comments-container').append(html);
                });
            }
        }).fail(function (xhr, status, error) {
            console.error('Error fetching comments:', error);
        }).always(function () {
            if (fromPages === true) {
                $('html, body').animate({
                    scrollTop: $('#comments-container').offset().top - 50
                }, 300);
            }
        });
    }

    return function (config) {
        const commentsTab = $(config.commentsTabSelector),
            requiredCommentTabRole = 'tab';

        if (commentsTab.attr('role') === requiredCommentTabRole && commentsTab.hasClass('active')) {
            processComments(config.getCommentsUrl, location.hash === '#comments-container');
        } else {
            commentsTab.one('beforeOpen', function () {
                processComments(config.getCommentsUrl);
            });
        }
    };
});
