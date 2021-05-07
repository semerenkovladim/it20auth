export default {
    state: {
        departments: null,
        departmentId: null,
        department: null,
        nextPage: '',
        prevPage: '',
        validationErrs: null,
        headers: null,
    },

    mutations: {
        updateDepartments(state, departments) {
            state.departments = departments;
        },
        updateDepartment(state, department) {
            state.department = department;
        },
        updateNextPage(state, nextPage) {
            state.nextPage = nextPage;
        },
        makePagination(state, res) {
            state.nextPage = res.next_page_url;
            state.prevPage = res.prev_page_url;
        },
        updateHeaders(state, headers) {
            state.headers = headers
        },
        collectValidErrors(state, err) {
            state.validationErrs = err;
        }
    },
    actions: {
        async fetchDepartments(ctx, url = `api/departments/`) {

            return await axios
                .get(url)
                .then(res => {
                    ctx.commit('updateDepartments', res.data.data.data)
                    ctx.commit('makePagination', res.data)
                })
                .catch(err => console.log('error:', err))
        },

        async fetchDepartment(ctx, departmentId) {

            return await axios
                .get(`/api/departments/${departmentId}`)
                .then((res) => (ctx.commit('updateDepartment', res)))
                .catch(err => console.log('error:', err)
                );
        },

        async fetchHeaders(ctx) {

            return await axios
                .get(`/api/users`)
                .then(res => {
                    ctx.commit('updateHeaders', res.data.data.data)
                })
                .catch(err => console.log('error:', err)
                );
        },


        async delDepartment(ctx, idDel) {

            return await axios
                .delete(`api/departments/${idDel}`)
                .then(res => console.log(res))
                .catch(err => console.log(err))
        },

        async createNewDepartment(ctx, data) {
            await axios
                .post('/api/departments/create', {
                    title: data.title,
                    head_department: data.head_department,
                })
                .then(res => {
                    console.log(data);
                })
                .catch(err => console.log(err))
        },
    },
    getters: {
        getDepartments(state) {
            return state.departments
        },
        getDepartment(state) {
            return state.department
        },
        getNextPage(state) {
            return state.nextPage
        },
        getPrevPage(state) {
            return state.prevPage
        },
        getValidationErrs(state) {
            return state.validationErrs
        },
        getHeaders(state) {
            return state.headers
        }
    },
}
