import {BaseHttpClient} from "~/services/http";

export class ArticlesService extends BaseHttpClient {

    async list(cursor = null) {
        return this.getAsync('articles', 'articles', {params: {cursor}});
    }

    async get(slug: any) {
        return this.getAsync('articles-slug', `articles/${slug}`);
    }
}