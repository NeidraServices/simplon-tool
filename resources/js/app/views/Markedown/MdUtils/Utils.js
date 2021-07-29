import Utils from '../../../helpers/utils';

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
                    category: item.markdown.category.name,
                    title: item.markdown.title,
                    description: item.markdown.description,
                    date: Utils.formatDate(item.updated_at ? item.updated_at : ((item.created_at) ? item.created_at : null))
                })
            })
        }
        return formatedData
    }

}
