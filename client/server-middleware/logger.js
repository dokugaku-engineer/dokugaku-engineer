export default function (req, res, next) {
  console.log('Request received:', req.url);
  next();
}
