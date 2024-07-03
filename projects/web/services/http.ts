export abstract class BaseHttpClient {
    protected baseURL: string;
    protected headers: Record<string, string>;

    constructor() {
        this.baseURL = 'https://api.zhbn.local/api/v1/';
        this.headers = {
            'Content-Type': 'application/json',
            accept: 'application/json'
        };
    }

    protected async getAsync(name: string, url: string, params?: Record<string, any>) {
        const { data } = await useAsyncData(name, () =>
            $fetch(this.baseURL + url, {
                headers: this.headers,
                params
            })
        );

        return data;
    }
}