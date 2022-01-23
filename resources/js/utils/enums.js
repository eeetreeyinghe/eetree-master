export default {
    types: {
        doc: 0,
        project: 1,
    },
    order: {
        status: {
            submit: 1,
            paid: 2,
            other: 3,
        }
    },
    status: {
        draft: 0,
        submit: 1,
        refuse: 8,
        pass: 9,
    },
    product: {
        types: {
            component: 0,
            software: 1,
            tool: 2,
        }
    },
    project: {
        type: {
            crowdfund: 0,
            share: 1,
            activity: 2,
        }
    }
}