<template>
	<div>
		<div class="d-flex justify-content-start mb-4" v-if="data.name == 'manager'">
			<div class="img_cont_msg">
				<img src="" class="rounded-circle user_img_msg">
			</div>
			<div class="msg_cotainer">
				{{ data.message }}
				<!-- <span class="msg_time">{{ data.created_at }}</span> -->
			</div>
		</div>
		<div class="d-flex justify-content-end mb-4" v-if="data.name == 'client'">
			<div class="msg_cotainer_send">
				{{ data.message }}
				<!-- <span class="msg_time_send">{{ data.created_at }}</span> -->
			</div>
			<div class="img_cont_msg">
				<img src="" class="rounded-circle user_img_msg">
			</div>

		</div>
	</div>
</template>

<script>
	
	export default {
		props:['data']
	}

</script>