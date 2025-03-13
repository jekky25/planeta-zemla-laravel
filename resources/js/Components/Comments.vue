<template>
	<div v-if="post.comments" id="jc">
		<div id="comments">
			<h4>Комментарии
				<a class="rss" :href="route('comment.rss',[post.category.slug, post.id, post.slug])" title="RSS лента комментариев этой записи" target="_blank">&nbsp;</a>
			</h4>
			<div id="comments-list" class="comments-list">
				<template v-for="(comment, index) in post.comments">
					<div class="even" :id="`comment-item-${comment.id}`">
						<div class="rbox">
							<div class="rbox_tr">
								<div class="rbox_tl">
									<div class="rbox_t">&nbsp;</div>
								</div>
							</div>
							<div class="rbox_m">
								<div class="comment-box usertype-guest">
									<span class="comments-vote">
										<span :id="`comment-vote-holder-${comment.id}`">
											<a v-if="comment.votes" href="#" class="vote-good" title="Хороший комментарий!" v-on:click.prevent="voteComment(comment.id, 1);"></a>
											<a v-if="comment.votes" href="#" class="vote-poor" title="Плохой комментарий!" v-on:click.prevent="voteComment(comment.id, -1);"></a>
											<span :class="comment.voteClass">{{ comment.voteCount }}</span>
										</span>
									</span>
									<Link class="comment-anchor" :href="`${route('item.name',[post.category.slug, post.id, post.slug])}#comment-${post.id}`" :id="`comment-${post.id}`">#{{ index }}</Link>
									<span class="comment-author">{{ comment.name }}</span>
									<span class="comment-date">{{ comment.date }}</span>
									<div class="comment-body" :id="`comment-body-${comment.id}`" v-html="comment.text"></div>
									<span class="comments-buttons">
										<a href="#" v-on:click.prevent="quoteComment(comment.id);">Цитировать</a>
									</span>
								</div>
								<div class="clear"></div>
							</div>
							<div class="rbox_br">
								<div class="rbox_bl">
									<div class="rbox_b">&nbsp;</div>
								</div>
							</div>
						</div>
					</div>
				</template>
			</div>
			<div id="comments-list-footer">
				<a class="rss" :href="route('comment.rss',[post.category.slug, post.id, post.slug])" target="_blank">RSS лента комментариев этой записи</a>
			</div>
		</div>
		<FormAddComment ref="formAddComment" :post="post"></FormAddComment>
	</div>
</template>
<script setup>
import FormAddComment from '@/Components/FormAddComment.vue';
</script>
<script>
import {Link, router} from '@inertiajs/vue3';
export default {
	name: "Comments",
	props: [
		'post',
	],
	data() {
		return {
			errors: '',
			success: '',
			regexpEmail:/^(?:[a-z0-9._]+(?:[-_.]?[a-z0-9._]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i,
			id: 0,
			name:'',
			email:'',
			message:'',
			post_id: 0,
			recaptcha_response: '',
			data: Object
		};
	},
	methods: {
		voteComment(id, vote)
		{
			let data = {
				vote : vote
			};

			axios.patch(route('post.update', {id}), data)
			.then(res => {
				router.reload();
				this.$refs.formAddComment.reloadCaptcha();
			})
			.catch(res => {
				this.errors = res.data;
			});
			return false;
		},
		async ajax($path)
		{
			let r;
			await axios.get($path)
			.then(res => {
				r = res.data;
			})
			.catch(res => {
				this.$data.errors += '<p>' + res.response.data.message + '</p>';
			});
			return r;
		},
		async quoteComment(id){
			let comment = await this.ajax(route('comment.id.ajax', id));
			let mes = this.$refs.formAddComment.message.length == 0 ? '' : '\n';
				mes += '[quote]' + comment.text + '[/quote]\n';
			this.$refs.formAddComment.message += mes;
		}
	}
}
</script>