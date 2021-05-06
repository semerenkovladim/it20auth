export default function auth ({ next }){
    const store = JSON.parse(window.localStorage.getItem('vuex'));
    const user = store.user;
    const access_token = store.access_token;
    const refresh_token = store.refresh_token;
    if(!user || !access_token || !refresh_token){
        return next({
            name: 'login.index'
        })
    }
    return next()
}
