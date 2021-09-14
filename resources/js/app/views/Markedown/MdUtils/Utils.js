import Utils from '../../../helpers/utils';
const utils = new Utils()
export class MdUtils {
    static FormatMdData(data){
        let formatedData = []
        if(Array.isArray(data)){
            data.map(item => {
                formatedData.push({
                    id: item.id,
                    category: item.md_category_id,
                    title: item.title,
                    status: item.status,
                    description: item.description,
                    author: "user"+item.user_id
                })
            })
        }
        return formatedData
    }

    static FormatMdArchive(data){
        let formatedData = []
        if(Array.isArray(data)){
            data.map(item => {
                formatedData.push({
                    id: item.id,
                    title: item.title,
                    category: item.category.name,
                    description: item.description,
                    date: utils.formatDate(item.updated_at ? item.updated_at : ((item.created_at) ? item.created_at : null))
                })
            })
        }
        return formatedData
    }

    formatDataMdCom(data) {
        let formatedData = []
        if (Array.isArray(data)) {
            data.map(item => {
                formatedData.push({
                    id: item.id,
                    category: item.category.name,
                    description: item.description,
                    title: item.title,
                    status: item.status,
                    created: utils.formatDate(item.created_at),
                    author: utils.formatName(item.user.surname, item.user.name)
                })
            })
        }
        return formatedData
    }
}
