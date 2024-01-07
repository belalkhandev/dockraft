<template>
    <div>
        <div ref="viewer" />
    </div>
</template>

<script setup>
import { Editor } from "@toast-ui/editor";
import 'prismjs/themes/prism.css'
import '@toast-ui/editor/dist/toastui-editor.css';
import 'tui-color-picker/dist/tui-color-picker.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';
import '@toast-ui/editor-plugin-code-syntax-highlight/dist/toastui-editor-plugin-code-syntax-highlight.css'
import '@toast-ui/editor/dist/toastui-editor-viewer.css';
import codeSyntaxHighlightPlugin from "@toast-ui/editor-plugin-code-syntax-highlight";
import Prism from 'prismjs'

import {onMounted, ref, watch} from "vue";

const props = defineProps({
    content: {
        type: String,
        required: true,
    },
});

const viewer = ref();

onMounted(() => {
    const e = new Editor.factory({
        el: viewer.value,
        initialValue: props.content,
        viewer: true,
        plugins: [[codeSyntaxHighlightPlugin, {highlighter: Prism}]],
    });

    watch(() => props.content, (newContent) => {
        e.setMarkdown(newContent)
    });
});

</script>


<style>
</style>
