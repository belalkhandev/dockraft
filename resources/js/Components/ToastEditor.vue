<template>
    <div>
        <div ref="editor" />
    </div>
</template>

<script setup>
import { Editor } from "@toast-ui/editor";
import '@toast-ui/editor/dist/toastui-editor.css';
import 'tui-color-picker/dist/tui-color-picker.css';
import '@toast-ui/editor-plugin-code-syntax-highlight/dist/toastui-editor-plugin-code-syntax-highlight.css'
import colorPlugin from "@toast-ui/editor-plugin-color-syntax";
import codeSyntaxHighlightPlugin from "@toast-ui/editor-plugin-code-syntax-highlight";
import Prism from 'prismjs'
import 'prismjs/themes/prism.css'

import {onMounted, ref} from "vue";

const props = defineProps({
    modelValue: {
        type: String,
        required: false,
        default: '',
    },
    height: {
        type: String,
        default: '300px',
    },
});

const emit = defineEmits(['update:modelValue']);
const editor = ref();

onMounted(() => {
    const e = new Editor({
        el: editor.value,
        height: props.height,
        initialEditType: 'markdown',
        previewStyle: 'tab',
        usageStatistics: false,
        initialValue: props.modelValue,
        toolbarItems: [
            ['code', 'codeblock'],
            ['heading', 'bold', 'italic'],
            ['hr', 'quote'],
            ['ul', 'ol'],
            ['table', 'image', 'link'],
            ['scrollSync'],
        ],
        plugins: [colorPlugin, [codeSyntaxHighlightPlugin, {highlighter: Prism}]],
        events: {
            change: () => emit('update:modelValue', e.getMarkdown()),
        },
    });
});

</script>


<style scoped>

</style>
