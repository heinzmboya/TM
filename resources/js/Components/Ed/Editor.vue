<script setup>
import { onMounted, computed } from 'vue';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Bold from './Icons/Bold.vue';
import Italic from './Icons/Italic.vue';
import Underline from './Icons/Underline.vue';
import Ul from './Icons/Ul.vue';
import UnderlineExt from '@tiptap/extension-underline';

const emit = defineEmits(['update']);

// const model = defineModel();

const editor = useEditor({
    editorProps: {
        attributes: {
            class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto focus:outline-none px-3 py-1 !text-sm',
        },
    },
    content: '<p>T-<u>manager</u>...</p>',
    extensions: [StarterKit, UnderlineExt],
    onUpdate: () => {
        // model.value = editor.value.getHTML();
        // {
        //     html: editor.value.getHTML(),
        //     text: editor.value.getText(),
        // };
        emit('update', {
            text: editor.value.getText(),
            html: editor.value.getHTML(),
        });
    },
});

onMounted(() => {
    emit('update', {
        text: editor.value.getText(),
        html: editor.value.getHTML(),
    });
});

const btnList = computed(() => [
    {
        title: 'bold',
        icon: Bold,
        action: () => editor.value.chain().focus().toggleBold().run(),
    },
    {
        title: 'italic',
        icon: Italic,
        action: () => editor.value.chain().focus().toggleItalic().run(),
    },
    {
        title: 'underline',
        icon: Underline,
        action: () => editor.value.chain().focus().toggleUnderline().run(),
    },
    {
        title: 'h1',
        action: () =>
            editor.value.chain().focus().toggleHeading({ level: 1 }).run(),
    },
    {
        title: 'bulletList',
        icon: Ul,
        action: () => editor.value.chain().focus().toggleBulletList().run(),
    },
]);
</script>
<template>
    <div
        v-if="editor"
        class="editor border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1"
    >
        <editor-content class="!prose" :editor="editor" />

        <section class="px-3 pb-2 flex gap-x-4">
            <button type="button" v-for="btn in btnList" @click="btn.action">
                <component v-if="btn.icon" :is="btn.icon" />
                <div class="text-gray-900 text-lg" v-else>H</div>
            </button>
        </section>
    </div>
</template>
