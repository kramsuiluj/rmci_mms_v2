require('./bootstrap');

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()


import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css';

const editor = new Editor({
    el: document.querySelector('#editor'),
    height: '400px',
    initialEditType: 'markdown',
    placeholder: 'Write something cool!',
})

document.querySelector('#createAssignment').addEventListener('submit', e => {
    e.preventDefault();
    document.querySelector('#content').value = editor.getMarkdown();
    e.target.submit();
});

// document.querySelector('#sendAnswer').addEventListener('submit', e => {
//     e.preventDefault();
//     document.querySelector('#content').value = editor.getMarkdown();
//     e.target.submit();
// });
