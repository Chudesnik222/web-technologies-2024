// js/post.js

const postContainer = document.getElementById('post');
const commentsContainer = document.getElementById('comments');

// Получаем id поста из адресной строки
const urlParams = new URLSearchParams(window.location.search);
const postId = urlParams.get('id');

if (!postId) {
    postContainer.innerHTML = '<p>Ошибка: не указан ID поста</p>';
} else {
    fetchPostAndComments(postId);
}

// Получение поста и комментариев
async function fetchPostAndComments(id) {
    try {
        // Получаем пост
        const postResponse = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}`);
        if (!postResponse.ok) {
            throw new Error('Ошибка при получении поста');
        }
        const post = await postResponse.json();
        renderPost(post);

        // Получаем комментарии
        const commentsResponse = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}/comments`);
        if (!commentsResponse.ok) {
            throw new Error('Ошибка при получении комментариев');
        }
        const comments = await commentsResponse.json();
        renderComments(comments);

    } catch (error) {
        postContainer.innerHTML = `<p>Ошибка: ${error.message}</p>`;
    }
}

// Отрисовка поста
function renderPost(post) {
    postContainer.innerHTML = `
        <h2>${post.title}</h2>
        <p>${post.body}</p>
        <a href="index.html">← Назад ко всем постам</a>
    `;
}

// Отрисовка комментариев
function renderComments(comments) {
    commentsContainer.innerHTML = '<h3>Комментарии:</h3>';

    comments.forEach(comment => {
        const commentElement = document.createElement('div');
        commentElement.className = 'comment';
        commentElement.innerHTML = `
            <p><strong>${comment.name}</strong> (${comment.email})</p>
            <p>${comment.body}</p>
            <hr>
        `;
        commentsContainer.appendChild(commentElement);
    });
}