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
        desc: true

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
            state.links = res.links;
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
        }
    },
    actions: {
        async fetchDepartments(ctx, orderBy = 'id', desc = "false", url =`api/departments`,) {
            console.log('common' + desc)
            return await axios
                .get(url, {
                    params: {
                        orderBy: orderBy,
                        desc: desc
                    }
                })
                .then(res => {
                    ctx.commit('updateDepartments', res.data.data)
                    ctx.commit('makePagination', res.data)
                    console.log(res.data)

                })
                .catch(err => console.log('error:', err))
        },

        async fetchDepartmentsDesc(ctx, orderBy = 'id', desc = "true", url =`api/departments`) {
            return await axios
                .get(url, {
                    params: {
                        orderBy: orderBy,
                        desc: desc
                    }
                })
                .then(res => {
                    ctx.commit('updateDepartments', res.data.data)
                    ctx.commit('makePagination', res.data)

                })
                .catch(err => console.log('error:', err))
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
                .catch(err => console.log('error:', err)
                );
        },

        async fetchLeads(ctx) {

            return await axios
                .get(`/api/users`)
                .then(res => {
                    ctx.commit('updateLeads', res.data.data.data)
                })
                .catch(err => console.log('error:', err)
                );
        },

        async fetchDepMembers(ctx, departmentId) {

            return await axios
                .get(`/api/users/${departmentId}`)
                .then(res => {
                    ctx.commit('updateDepMembers', res.data)
                })
                .catch(err => console.log('error:', err)
                );
        },

        async createNewDepartment(ctx, data) {
            await axios
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
                    console.log(res.status)
                })
        },
        async updateDepartment(ctx, data) {
            let id = data.id;
            await axios
                .put(`/api/departments/${id}`, {
                    title: data.title,
                    head_department: data.head_department,
                })
                .then(res => {
                    ctx.commit('updateResStatusEditDep', res.status)
                    console.log(res.status)
                })
                .catch(err => {
                    ctx.commit('updateResStatusEditDep', err.error)
                    console.log(data)
                })
        },
        async deleteUsers(ctx, user) {
            await axios
                .put(`/api/user/reset-department/${user}`)
                .then(res => {
                    console.log('update');
                })
                .catch(err => console.log(err))
        },

        async delDepartment(ctx, idDel) {

            return await axios
                .delete(`api/departments/${idDel}`)
                .then()
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

        getValidationErrs(state) {
            return state.validationErrs
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

        getSortedList(state) {
            return state.sortedList
        },
    },
}
