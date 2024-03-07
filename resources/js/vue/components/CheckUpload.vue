<template>
    <slot name="inputs"></slot>
    <div className="check_load">
        <div className="check_load_wrapper" v-bind="getRootProps()">
            <input v-bind="getInputProps()" type="file"/>
            <div className="check_load_img">
                <h3 v-if="acceptFiles.length > 0">
                   Чек Загружен
                </h3>
                <h4 v-else>Выбрать на устройстве</h4>
                <div className="check_load_text">
          <span class="file-name" v-if="acceptFiles.length > 0">
            {{ acceptFiles[0].name }}
          </span>

                </div>
                <div v-bind="getRootProps()" className="check_default">
                    <input v-bind="getInputProps()" type="file" name="image"/>
                    <slot name="file_error"></slot>
                </div>
            </div>
        </div>
    </div>

    <div className="check_btn">
        <button :disabled="acceptFiles.length == 0" className="btn" type="submit">
            Зарегистрировать чек
        </button>
    </div>
</template>

<script>
import {ref} from "vue";
import {useDropzone} from "vue3-dropzone";

export default {
    props: {},
    setup(thing, {emit}) {
        const acceptFiles = ref([]);
        const textFile = ref('');

        function onDrop(accept_files, rejectReasons) {
            acceptFiles.value = accept_files;
            textFile.value = accept_files;
            console.log(accept_files);
            console.log(rejectReasons);
            emit('added', accept_files[0])
        }

        const options = {
            onDrop,
            accept: 'image/*',
            multiple: false
        }

        const {getRootProps, getInputProps, ...rest} = useDropzone(options);

        return {
            getRootProps,
            getInputProps,
            acceptFiles,
            textFile,
            ...rest,
        };
    },
    methods: {},
};
</script>


