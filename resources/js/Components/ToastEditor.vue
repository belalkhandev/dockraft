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
});

const emit = defineEmits(['update:modelValue']);
const editor = ref();

onMounted(() => {
    const e = new Editor({
        el: editor.value,
        height: '1000px',
        initialEditType: 'markdown',
        previewStyle: 'tab',
        usageStatistics: false,
        plugins: [colorPlugin, [codeSyntaxHighlightPlugin, {highlighter: Prism}]],
        events: {
            change: () => emit('update:modelValue', e.getHTML()),
        },
    });
});

</script>


<style scoped>

</style>
