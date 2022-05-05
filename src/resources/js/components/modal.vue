<template>
	<div>
        <div class="absolute m-5 ml-36">
            <button type="button" @click="openModal" class="flex shadow w-32 block border-gray-400 border-2 rounded-full px-4 py-2 text-gray-400 hover:bg-gray-200 hover:text-white">
                <span class="m-auto">CSV出力</span>
            </button>
        </div>
		<div id="modal" v-show="isOpen">
			<div id="modal__box">
				<span id="modal__message">CSV出力しますか?</span>
				<div id="modal__action">
                    <form :action="url">
                        <input type="submit" value="CSV出力する" id="modal__btn" class="suc" @click="closeModal">
                    </form>
                    <div id="modal__btn" class="not" @click="closeModal">キャンセル</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: {
        url: {
        type: String,
      },
    },
	data() {
      return {
        isOpen: false,
        url: this.url,
      }
    },
	methods: {
		openModal(){
			this.isOpen = true
		},
		closeModal() {
			this.isOpen = false
		}
	},
}
</script>

<style>
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

#modal {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	z-index: 10;
}

#modal__box {
	position: absolute;
	top: 50%;
	left: 50%;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	width: 500px;
	height: 200px;
	padding: 32px;
	background-color: #fff;
	border-radius: 4px;
	transform: translate(-50%, -50%);
}

#modal__message {
	font-size: 24px;
	text-align: center;
}

#modal__action {
	display: flex;
	justify-content: flex-end;
	margin: 0 auto;
}

#modal__btn {
	width: 130px;
	margin-left: 16px;
	padding: 8px;
	line-height: 1.5;
	font-weight: bold;
	border: 1px solid rgb(196, 196, 196);
	cursor: pointer;
	text-align: center;
}

.not {
	background-color: #999999;
	color: #fff;
}

.suc {
	color: #fff;
	border: none;
	background-color: rgb(60, 140, 245);
}
</style>