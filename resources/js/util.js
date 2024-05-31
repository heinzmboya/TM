export const priorityEnum = {
    ALL: 'all',
    HIGHEST: 'highest',
    HIGH: 'high',
    MEDIUM: 'medium',
    LOW: 'low',
    LOWEST: 'lowest',
}
export const statusEnum = {
    PENDING: 'pending',
    BACKLOG: 'backlog',
    COMPLETE: 'complete',
}

export function groupBy(array = [], property) {
    return array.reduce((groups, item) => {
        const key = item[property];
        groups[key] = groups[key] || [];
        groups[key].push(item);
        return groups;
    }, {});
}

export const avatar = "https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=300&auto=format&fit=crop&ixlib=rb-4.0.3"