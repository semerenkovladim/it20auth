export default {
    state: {
        departments: null,
        departmentId: null,
        department: null,
        nextPage: null,
        prevPage: null,
        currentPage: null,
        lastPage: null,
        leads: null,
        membersCount: null,
        depMembers: null,
        resStatus: null,
        ctrDepMembers: null,
        statusEditDep: null,
        links: null,
        showPopup: false,
        orderBy: "id",
        desc: true,

    },

    mutations: {
        updateDepartments(state, departments) {
            state.departments = departments;
        },

        updateDepartment(state, department) {
            state.department = department;
        },

        makePagination(state, res) {
            state.nextPage = res.next_page_url;
            state.prevPage = res.prev_page_url;
            state.currentPage = res.current_page;
            state.lastPage = res.last_page;
        },

        updateLeads(state, leads) {
            state.leads = leads
        },

        updateDepMembers(state, depMembers) {
            state.depMembers = depMembers;
        },

        updateResStatus(state, resStatus) {
            state.resStatus = resStatus;
        },

        updateResStatusEditDep(state, statusEditDep) {
            state.statusEditDep = statusEditDep;
        },

        updateDepartmentId(state, $departmentId) {
            state.departmentId = $departmentId;
        },

        updateCtrDepMembers(state, $ctrDepMembers) {
            state.ctrDepMembers = $ctrDepMembers;
        },

        updateShowPopup(state, status) {
            state.showPopup = status;
        },

        updateSortedList(state, list) {
            state.sortedList = list;
        },

        updateOrderBy(state, order) {
            state.orderBy = order;
        },

        updateDesc(state, desc) {
            state.desc = desc;
        },

        makeLinks(state, links) {
            state.links = links;
        },

    },
    actions: {
        async fetchDepartments(ctx, url = `api/departments`) {
            let order = this.getters.getOrderBy;
            let desc = this.getters.getDesc;

            return await axios
                .get(url, {
                    params: {
                        orderBy: order,
                        desc: desc
                    }
                })
                .then(res => {
                    if(res.data.data.length === 0){
                        ctx.commit('updateDepartments', false)
                    }
                    ctx.commit('updateDepartments', res.data.data)
                    ctx.commit('makePagination', res.data)
                    ctx.commit('makeLinks', res.data.links)

                })
        },

        setDepId(ctx, $departmentId) {
            ctx.commit('updateDepartmentId', $departmentId)
        },

        async fetchDepartment(ctx, departmentId) {

            return await axios
                .get(`/api/departments/${departmentId}`)
                .then(res => {
                    ctx.commit('updateDepartment', res.data)
                })
        },

        async fetchLeads(ctx) {

            return await axios
                .get(`/api/users/all`, {
                    params: {
                        orderBy: 'id',
                        desc: true
                    }
            })
                .then(res => {
                    ctx.commit('updateLeads', res.data)
                })
        },

        async fetchDepMembers(ctx, departmentId) {

            return await axios
                .get(`/api/users/${departmentId}`, {
                    params: {
                        orderBy: 'id',
                        desc: 'desc'
                    }
                })
                .then(res => {
                    ctx.commit('updateDepMembers', res.data.data.data)
                })
        },

        async createNewDepartment(ctx, data) {

            return await axios
                .post('/api/departments', {
                    title: data.title,
                    head_department: data.departmentHead,
                })
                .then(res => {
                    ctx.commit('updateResStatus', res.status)
                    ctx.commit('updateShowPopup', true)
                })
                .catch(res => {
                    ctx.commit('updateResStatus', res.status)
                })
        },
        async updateDepartment(ctx, data) {
            let id = data.id;

            return await axios
                .put(`/api/departments/${id}`, {
                    title: data.title,
                    head_department: data.head_department,
                })
                .then(res => {
                    ctx.commit('updateResStatusEditDep', res.status)
                })
                .catch(err => {
                    ctx.commit('updateResStatusEditDep', err.error)
                })
        },
        async deleteUsers(ctx, user) {

            return await axios
                .put(`/api/user/reset-department/${user}`)
        },

        async delDepartment(ctx, idDel) {

            return await axios
                .delete(`api/departments/${idDel}`)
                .then()
                .catch()
        },

        searchDepartment(ctx, data) {

            return axios.get('/api/departments-search', {
                params: {
                    data: data
                }
            })
                .then(res => {
                        ctx.commit('updateDepartments', res.data.data)
                        ctx.commit('makePagination', res.data)
                        ctx.commit('makeLinks', res.data.links)

                    })
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

        getLastPage(state) {
            return state.lastPage
        },

        getLinks(state) {
            return state.links
        },

        getPrevPage(state) {
            return state.prevPage
        },

        getCurrentPage(state) {
            return state.currentPage
        },

        getLeads(state) {
            return state.leads
        },

        getDepMembers(state) {
            return state.depMembers
        },

        getResStatus(state) {
            return state.resStatus
        },

        getDepartmentId(state) {
            return state.departmentId
        },

        getCtrDepMembers(state) {
            return state.ctrDepMembers
        },

        getResStatusEditDep(state) {
            return state.statusEditDep
        },

        getShowPopup(state) {
            return state.showPopup
        },

        getDesc(state) {
            return state.desc
        },

        getOrderBy(state) {
            return state.orderBy
        },
    },
}
