<template>
	<template v-if="post">
		<div class="componentheading"></div>
		<h2 v-if="post.category" class="contentheading"><Link :href="route('item.name',[post.category.slug, post.id, post.slug])" class="contentpagetitle">{{ post.title }}</Link></h2>
		<div class="article-content"><span v-html="post.introtext"></span><span v-html="post.fulltext"></span></div>
		<div v-if="post.comments" id="jc">
			<div id="comments">
				<h4>Комментарии
					<Link class="rss" :href="route('comment.rss',[post.category.slug, post.id, post.slug])" title="RSS лента комментариев этой записи" target="_blank">&nbsp;</Link>
					<Link class="refresh" href="#" title="Обновить список комментариев" onclick="jcomments.showPage(post.id ,'com_content',0);return false;">&nbsp;</Link>
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
											<Link href="#" :onclick="`jcomments.quoteComment(${comment.id}); return false;`">Цитировать</Link>
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
					<Link class="refresh" href="#" title="Обновить список комментариев" :onclick="`jcomments.showPage(${post.id},'com_content',0);return false;`">Обновить список комментариев</Link>
					<br />
					<Link class="rss" :href="route('comment.rss',[post.category.slug, post.id, post.slug])" target="_blank">RSS лента комментариев этой записи</Link>
				</div>
			</div>
			<h4>Добавить комментарий</h4>
			<Link id="addcomments" href="#addcomments"></Link>
			<form id="comments-form" name="comments-form" action="javascript:void(null);">
				<GoogleCaptcha></GoogleCaptcha>
				<p>
					<input id="comments-form-name" type="text" name="name" value="" maxlength="20" size="22" tabindex="1" class="">
					<label for="comments-form-name">Имя (обязательное)</label>
				</p>
				<p>
					<input id="comments-form-email" type="text" name="email" value="" size="22" tabindex="2">
					<label for="comments-form-email">E-Mail (обязательное)</label>
				</p>
				<p><textarea id="comments-form-comment" name="comment" cols="65" rows="8" tabindex="5"></textarea></p>
				<p>
					<input class="checkbox" id="comments-form-subscribe" type="checkbox" name="subscribe" value="1" tabindex="5">
					<label for="comments-form-subscribe">Подписаться на уведомления о новых комментариях</label><br>
				</p>
				<div id="comments-form-buttons">
					<div class="btn" id="comments-form-send"><div><Link href="#" tabindex="7" onclick="jcomments.saveComment();return false;" title="Отправить (Ctrl+Enter)">Отправить</Link></div></div>
					<div class="btn" id="comments-form-cancel" style="display:none;"><div><Link href="#" tabindex="8" onclick="return false;" title="Отменить">Отменить</Link></div></div>
					<div style="clear:both;"></div>
				</div>
				<input type="hidden" name="object_id" :value="post.id">
				<input type="hidden" name="object_group" value="com_content">
			</form>
		</div>
	</template>
</template>
<script setup>
import GoogleCaptcha from '@/Components/GoogleCaptcha.vue';
</script>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import {Link, router} from '@inertiajs/vue3';

export default {
	name: "Page",
	components: {
		Link
	},
	layout: MainLayout,
	props: [
		'post',
	],
	data() {
			return {
				errors: null
			};
	},
	methods: {
		JCommentsInitializeForm(jcomments)
			{
				var jcEditor = new JCommentsEditor('comments-form-comment', true);
					jcEditor.addButton('b','Жирный','Введите текст для форматирования');
					jcEditor.addButton('i','Курсив','Введите текст для форматирования');
					jcEditor.addButton('u','Подчеркнутый','Введите текст для форматирования');
					jcEditor.addButton('s','Зачеркнутый','Введите текст для форматирования');
					jcEditor.addButton('quote','Цитата','Введите текст цитаты');
					jcEditor.addButton('custombbcode1','YouTube Video','Введите текст для форматирования','[youtube]','[/youtube]','bbcode-youtube','');
					jcEditor.addButton('custombbcode4','Google Video','Введите текст для форматирования','[google]','[/google]','bbcode-google','');
					jcEditor.addButton('custombbcode8','Facebook Video','Введите текст для форматирования','[fv]','[/fv]','bbcode-facebook','');
					jcEditor.addButton('custombbcode10','Wikipedia','Введите текст для форматирования','[wiki]','[/wiki]','bbcode-wiki','');
					jcEditor.initSmiles('/images/smilies');
					jcEditor.addSmile(':D','laugh.gif');
					jcEditor.addSmile(':lol:','lol.gif');
					jcEditor.addSmile(':-)','smile.gif');
					jcEditor.addSmile(';-)','wink.gif');
					jcEditor.addSmile('8)','cool.gif');
					jcEditor.addSmile(':-|','normal.gif');
					jcEditor.addSmile(':-*','whistling.gif');
					jcEditor.addSmile(':oops:','redface.gif');
					jcEditor.addSmile(':sad:','sad.gif');
					jcEditor.addSmile(':cry:','cry.gif');
					jcEditor.addSmile(':o','surprised.gif');
					jcEditor.addSmile(':-?','confused.gif');
					jcEditor.addSmile(':-x','sick.gif');
					jcEditor.addSmile(':eek:','shocked.gif');
					jcEditor.addSmile(':zzz','sleeping.gif');
					jcEditor.addSmile(':P','tongue.gif');
					jcEditor.addSmile(':roll:','rolleyes.gif');
					jcEditor.addSmile(':sigh:','unsure.gif');
					jcEditor.addCounter(1000, 'Осталось:', ' символов', 'counter');
					jcomments.setForm(new JCommentsForm('comments-form', jcEditor));
			},
			voteComment(id, vote)
			{
				let data = {
					vote : vote
				};

				axios.patch(route('post.update', {id}), data)
				.then(res => {
					router.reload();
				})
				.catch(res => {
					this.errors = res.data;
				});
				return false;
			}
	},
	mounted()
	{
		var jcomments=new JComments( this.post.id , 'com_content',route('comment.ajax'));
		jcomments.setList('comments-list');
		this.JCommentsInitializeForm(jcomments);
	}
}
</script>