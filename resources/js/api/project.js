// 查找元器件/工具 
export function findProducts(params) {
    return axios({
      url: '/product/find',
      method: 'get',
      params
    })
}
// 项目
export function getPublishProjects(params) {
  return axios({
    url: '/projects',
    method: 'get',
    params,
  })
}
export function getColleges(params) {
  return axios({
    url: '/colleges',
    method: 'get',
    params,
  })
}
export function getRelates(params) {
  return axios({
    url: '/project-relate-drafts',
    method: 'get',
    params,
  })
}
export function getProjects(params) {
    return axios({
      url: '/project-drafts',
      method: 'get',
      params,
    })
}
export function getProject(id) {
    return axios({
      url: '/project-drafts/' + id,
      method: 'get'
    })
}
export function addProject() {
    return axios({
      url: '/project-drafts',
      method: 'post'
    })
}
export function updateProject(id, data) {
    return axios({
        method: 'put',
        url: '/project-drafts/' + id,
        data,
    })
}
export function getSchedules(params) {
    return axios({
      url: '/project-schedule-drafts',
      method: 'get',
      params
    })
}
export function addSchedule(data) {
    return axios({
      url: '/project-schedule-drafts',
      method: 'post',
      data
    })
}
export function deleteSchedule(id) {
    return axios({
      url: '/project-schedule-drafts/' + id,
      method: 'delete'
    })
}

export function updateSchedule(id, data) {
    return axios({
        method: 'put',
        url: '/project-schedule-drafts/' + id,
        data,
    })
}
export function addTeam(data) {
    return axios({
      url: '/project-team-drafts',
      method: 'post',
      data
    })
}
export function deleteTeam(id) {
    return axios({
      url: '/project-team-drafts/' + id,
      method: 'delete'
    })
}

export function updateTeam(id, data) {
    return axios({
        method: 'put',
        url: '/project-team-drafts/' + id,
        data,
    })
}
export function getProducts(params) {
    return axios({
      url: '/project-product-drafts',
      method: 'get',
      params
    })
}
export function updateProjectProducts(id, data) {
    return axios({
        method: 'put',
        url: '/project-drafts/' + id + '/products',
        data,
    })
}
export function updateProjectClouds(id, data) {
    return axios({
        method: 'put',
        url: '/project-drafts/' + id + '/clouds',
        data,
    })
}
export function updateProjectRelates(id, data) {
    return axios({
        method: 'put',
        url: '/project-drafts/' + id + '/relates',
        data,
    })
}
export function publishProject(id) {
    return axios({
        method: 'put',
        url: '/project-drafts/' + id + '/publish',
    })
}
export function cancelSubmit(id) {
    return axios({
        method: 'put',
        url: '/project-drafts/' + id + '/cancel',
    })
}
export function deleteProject(id) {
  return axios({
    url: '/project-drafts/' + id,
    method: 'delete'
  })
}
export function getClouds(params) {
    return axios({
      url: '/project-cloud-drafts',
      method: 'get',
      params
    })
}
export function getCourse(params) {
    return axios({
      url: '/project-course-drafts',
      method: 'get',
      params
    })
}
export function addCourse(data) {
    return axios({
      url: '/project-course-drafts',
      method: 'post',
      data
    })
}
export function deleteCourse(id) {
    return axios({
      url: '/project-course-drafts/' + id,
      method: 'delete'
    })
}
export function updateCourse(id, data) {
    return axios({
        method: 'put',
        url: '/project-course-drafts/' + id,
        data,
    })
}
export function getCase(params) {
    return axios({
      url: '/project-case-drafts',
      method: 'get',
      params
    })
}
export function addCase(data) {
    return axios({
      url: '/project-case-drafts',
      method: 'post',
      data
    })
}
export function deleteCase(id) {
    return axios({
      url: '/project-case-drafts/' + id,
      method: 'delete'
    })
}
export function updateCase(id, data) {
    return axios({
        method: 'put',
        url: '/project-case-drafts/' + id,
        data,
    })
}
export function moveCase(id, data) {
    return axios({
        method: 'put',
        url: '/project-case-drafts/' + id + '/move',
        data,
    })
}
export function getGoods(params) {
    return axios({
      url: '/project-goods-drafts',
      method: 'get',
      params
    })
}
export function addGoods(data) {
    return axios({
      url: '/project-goods-drafts',
      method: 'post',
      data
    })
}
export function deleteGoods(id) {
    return axios({
      url: '/project-goods-drafts/' + id,
      method: 'delete'
    })
}

export function updateGoods(id, data) {
    return axios({
        method: 'put',
        url: '/project-goods-drafts/' + id,
        data,
    })
}
