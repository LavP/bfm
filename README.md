# bfm
街のバリアフリー状況をまとめたマップです。


#サイト
https://kamata-bfm.nextlav.xyz

#API
投稿データをJSON形式でゲットできます。
実態はdata-api.phpです。
https://kamata-bfm.nextlav.xyz/data-api

以下のパラメタを使用して任意のデータを獲得できます。
?type = 'post name'
ex)?type=restroom,food  => トイレと飲食店の情報を取得します
ex)?type=all            => すべてのタイプの情報を取得します

?size = int
ex)?size = 5  => 最大５件の情報を取得します

?more = 0 or 1
ex)?more=1 => すべてのメタ情報を取得します

#サイトの閲覧パスワード
「qwertyuiop」

#テーマファイルのサーバーへのアップロード
ftpを使用してアップロードします。
認証情報は lavp@nextlav.xyz にリクエストしてください。
