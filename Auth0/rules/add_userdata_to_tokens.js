// ユーザーデータをトークンに追加する
function (user, context, callback) {
  const namespace = 'https://dokugaku-engineer.com/';
  context.idToken[namespace + 'providers'] = user.identities.map(identity => {
    return identity.provider;
  });

  // IDトークンはユーザー情報を取得するためのトークン
  if (context.idToken && user.user_metadata) {
    context.idToken[namespace + 'user_id'] = user.user_metadata.id;
  }

  // アクセストークンはAPIのアクセスを制御するためのトークン
  if (context.accessToken && user.user_metadata) {
    context.accessToken[namespace + 'user_id'] = user.user_metadata.id;
  }

  return callback(null, user, context);
}