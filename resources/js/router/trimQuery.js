export default function trimQuery ({ next, to }){
    let url;
    let index = to.path.split('');
    if(index[index.length - 1] == '/') {
        index.pop();
        url = index.join('');
        return next(url);
    } else {
        return next();
    }
}
