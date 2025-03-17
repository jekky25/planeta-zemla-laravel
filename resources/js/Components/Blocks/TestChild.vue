<script>
import SecondChild from '@/Components/Blocks/SecondChild.vue';

export default {
		name: 'TestChild',
        components: {
			SecondChild
		},
        data() {
		return {
			proba: 'aaaaaa',
			data: Object
			}
		},
        methods:
        {
            updateLocation()
            {
                alert('jjj');
                alert(this.proba);
                //alert(this.$refs.SecondChild.input);
            }
        }
}


//import { inject } from 'vue'

//const { location, updateLocation } = inject('location')

</script>
<template>
    <div>
test child
<SecondChild ref="SecondChild" v-model="proba"></SecondChild>
<button @click="updateLocation">Click {{ location }}</button>
	</div>
</template>
