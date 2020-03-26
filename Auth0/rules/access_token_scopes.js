// 全てのアクセストークンに適切なフォーマットのスコープが含まれているかを確認する
function (user, context, callback) {
  var permissions = user.permissions || [];
  var requestedScopes = context.request.body.scope || context.request.query.scope;
  var filteredScopes = requestedScopes.split(' ').filter(function (x) {
    return x.indexOf(':') < 0;
  });

  var allScopes = filteredScopes.concat(permissions);
  context.accessToken.scope = allScopes.join(' ');

  callback(null, user, context);
}