document.addEventListener('DOMContentLoaded', function() {
    // Blog post delete
    document.querySelectorAll('.delete-blog-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('Delete this blog post?')) return;
            fetch('deleteBlog.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `blog_id=${encodeURIComponent(btn.dataset.blogId)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Remove the blog post section from the DOM
                    btn.closest('.page__blogpost').remove();
                }
            });
        });
    });

    // Reply functionality
    document.querySelectorAll('.reply-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const area = btn.parentElement;
            // Prevent multiple reply boxes
            if (area.querySelector('.reply-form')) return;
            btn.style.display = 'none';


            const form = document.createElement('div');
            form.className = 'reply-form';

            const textarea = document.createElement('textarea');
            textarea.className = 'reply-text';
            textarea.rows = 3;
            textarea.placeholder = 'Type your reply...';

            const actionsDiv = document.createElement('div');
            actionsDiv.className = 'reply-actions';

            const cancelBtn = document.createElement('button');
            cancelBtn.className = 'cancel-reply-btn';
            cancelBtn.textContent = 'Cancel';

            const postBtn = document.createElement('button');
            postBtn.className = 'post-reply-btn';
            postBtn.textContent = 'Post';

            actionsDiv.appendChild(cancelBtn);
            actionsDiv.appendChild(postBtn);
            form.appendChild(textarea);
            form.appendChild(actionsDiv);
            area.appendChild(form);

            cancelBtn.onclick = function() {
                form.remove();
                btn.style.display = '';
            };

            postBtn.onclick = function() {
                // AJAX post reply (see below)
                const blogId = area.closest('.page__blogpost').dataset.blogId;
                const content = textarea.value.trim();
                if (!content) return;
                fetch('postReply.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `blog_post_id=${encodeURIComponent(blogId)}&content=${encodeURIComponent(content)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload to show new reply
                    }
                });
            };
        });
    });

    // Delete reply
    document.querySelectorAll('.delete-reply-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('Delete this reply?')) return;
            fetch('deleteReply.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `reply_id=${encodeURIComponent(btn.dataset.replyId)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    btn.closest('.reply-box').remove();
                }
            });
        });
    });
});