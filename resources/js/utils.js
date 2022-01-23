export function deepClone(source) {
    if (!source && typeof source !== 'object') {
      throw new Error('error arguments', 'deepClone')
    }
    const targetObj = source.constructor === Array ? [] : {}
    Object.keys(source).forEach(keys => {
      if (source[keys] && typeof source[keys] === 'object') {
        targetObj[keys] = deepClone(source[keys])
      } else {
        targetObj[keys] = source[keys]
      }
    })
    return targetObj
}

export function unflatten(arr) {
  const tree = []
  const mappedArr = {}
  let arrElem
  let mappedElem
  // First map the nodes of the array to an object -> create a hash table.
  for (let i = 0, len = arr.length; i < len; i++) {
    arrElem = arr[i]
    mappedArr[arrElem.id] = arrElem
    mappedArr[arrElem.id]['children'] = []
  }

  for (const id in mappedArr) {
    if (mappedArr.hasOwnProperty(id)) {
      mappedElem = mappedArr[id]
      // If the element is not at the root level, add it to its parent array of children.
      if (mappedElem.parent_id) {
        if (mappedArr.hasOwnProperty(mappedElem.parent_id)) {
          mappedArr[mappedElem.parent_id].children.push(mappedElem)
          mappedArr[mappedElem.parent_id].children.sort((a, b) => a.order - b.order)
        }
      } else { // If the element is at the root level, add it to first level elements array.
        tree.push(mappedElem)
        if (typeof mappedElem['order'] !== 'undefined') {
          tree.sort((a, b) => a.order - b.order)
        }
      }
    }
  }
  return tree
}

export function stripTags(html) {
  return html.replace(/<[^>]+>/g, '');
}

export function checkCloud(rule, value, callback) {
  setTimeout(() => {
    if (!Number.isInteger(value)) {
      callback(new Error('请上传图片'));
    } else {
      if (value <= 0) {
        callback(new Error('请上传图片'));
      } else {
        callback();
      }
    }
  }, 500);
}

export function checkMobile(rule, value, callback) {
  if (!/^1[0-9]{10}$/.test(value)) {
    callback(new Error('请填写正确的手机号!'));
  } else {
    callback();
  }
}
