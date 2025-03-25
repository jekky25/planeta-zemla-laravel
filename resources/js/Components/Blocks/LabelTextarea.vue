<script>
import Textarea from '@/Components/Forms/Textarea.vue';

export default {
		name: 'LabelTextarea',
        components: {
			Textarea
		},
		data() {
				return {
                    inputName:'',
                    data: Object
				};
                
			},
        props: {
            id: {
                type: String,
                default: null
            },
            name: {
                type: String,
                default: null
            },
            model: {
                type: String,
                default: null
            },

        },
		methods:
		{
            get()
            {
                return this.inputName;
            }
		}
	}
</script>
<template>
    <div class="mb-4">
		<label :for="this.id"><slot /></label>
			<br />
            <Textarea v-model="inputName" :name="this.name" :id="this.id" ref="InputField"></Textarea>
	</div>
</template>