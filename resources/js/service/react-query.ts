/* eslint-disable @typescript-eslint/ban-ts-comment */
import {
    useMutation,
    useQuery,
    UseQueryOptions,
    QueryFunctionContext,
    UseMutationOptions,
    useInfiniteQuery,
    UseInfiniteQueryOptions,
    QueryKey,
    InfiniteData,
} from "@tanstack/react-query";
import { AxiosError } from "axios";

import AxiosService, { INSTANCES } from "./axios-service";

type QueryKeyT = (string | object | undefined)[] | QueryKey;

type Pagination = {
    count: number;
    pageCount: number;
    pageNumber: number;
    pageSize: number;
};

export interface BaseResponse<T> {
    status: boolean;
    body: T;
    pagination?: Pagination;
}

export interface BaseError<T> {
    devCode: string;
    errors: T;
    msg: string;
    message?: string;
    stack: string;
    status: false;
    statusCode: number;
}

export interface PaginationResponse<T> extends BaseResponse<T> {
    pagination: Pagination;
}

export const fetcher = <T>(
    { signal }: QueryFunctionContext<QueryKeyT>,
    url: string,
    instance?: INSTANCES,
    method?: string,
    headers?: object,
    params?: object
) => {
    const api = AxiosService[instance ?? INSTANCES.BASE];
    return api<BaseResponse<T>>(url, {
        method: method || "GET",
        params: { ...params },
        headers,
        signal,
    }).then((res) => res.data);
};

export const pagingFetcher = <T>(
    { pageParam }: QueryFunctionContext<QueryKeyT, unknown>,
    url: string,
    instance?: INSTANCES,
    method?: string,
    headers?: object,
    params?: object
): Promise<PaginationResponse<T>> => {
    const api = AxiosService[instance ?? INSTANCES.BASE];
    return api<PaginationResponse<T>>(url, {
        method: method || "GET",
        params: { ...params, page: pageParam },
        headers,
    }).then((res) => res.data);
};

export const useFetch = <T, TError = any, TData = BaseResponse<T>>({
    url,
    params,
    instance,
    method,
    headers,
    queryKey,
    ...config
}: {
    url: string;
    params?: object;
    headers?: object;
    instance?: INSTANCES;
    method?: string;
} & UseQueryOptions<
    BaseResponse<T>,
    AxiosError<BaseError<TError>>,
    TData,
    QueryKeyT
>) => {
    const context = useQuery<
        BaseResponse<T>,
        AxiosError<BaseError<TError>>,
        TData,
        QueryKeyT
    >({
        queryKey: queryKey || [url, params, headers],
        queryFn: ({ queryKey, ...otherProps }) =>
            fetcher(
                { queryKey, ...otherProps },
                url,
                instance,
                method,
                headers,
                params
            ),
        enabled: !!url,
        ...config,
    });

    return context;
};

export const useLoadMore = <T>({
    url,
    params,
    instance,
    method,
    headers,
    queryKey,
    ...options
}: {
    url: string;
    params?: object;
    instance?: INSTANCES;
    method?: string;
    headers?: object;
} & Partial<
    UseInfiniteQueryOptions<
        PaginationResponse<T>,
        Error,
        InfiniteData<PaginationResponse<T>>
    >
>) => {
    const context = useInfiniteQuery<
        PaginationResponse<T>,
        Error,
        InfiniteData<PaginationResponse<T>>
    >({
        queryKey: queryKey || [url, params, headers],
        queryFn: ({ queryKey, pageParam = 1, ...otherProps }) =>
            pagingFetcher(
                { queryKey, pageParam, ...otherProps },
                url,
                instance,
                method,
                headers,
                params
            ),
        initialPageParam: 1,
        getNextPageParam: (lastPage) => {
            return lastPage.pagination.pageNumber <
                lastPage.pagination.pageCount
                ? lastPage.pagination.pageNumber + 1
                : undefined;
        },
        ...options,
    });

    return context;
};

const replaceUrlParams = (
    urlTemplate: string,
    params: Record<string, string>
) => {
    const regex = /\{(\w+)\}/g;
    return urlTemplate.replace(regex, (match, key) => params[key] || match);
};

type PayloadT = { [name: string]: string };
export const useMutate = <TData, TPayLoad = PayloadT, TError = any>({
    url,
    params = {},
    headers = {},
    instance,
    method,
    ...options
}: {
    url: string;
    params?: object;
    headers?: object;
    instance?: INSTANCES;
    method?: string;
} & Omit<
    UseMutationOptions<
        BaseResponse<TData>,
        AxiosError<BaseError<TError>>,
        TPayLoad
    >,
    "mutationFn"
>) => {
    const api = AxiosService[instance ?? INSTANCES.BASE];
    const request = async (payload: TPayLoad) => {
        const {
            urlParams = {},
            extraHeaders = {},
            ...rest
        } = payload as PayloadT;

        const formattedUrl = replaceUrlParams(url, urlParams);

        const { data } = await api<BaseResponse<TData>>(formattedUrl, {
            method: method || "POST",
            params,
            headers: {
                ...headers,
                ...extraHeaders,
            },
            ...(method !== "GET" && {
                data: { ...rest },
            }),
        });
        return data;
    };

    return useMutation<
        BaseResponse<TData>,
        AxiosError<BaseError<TError>>,
        TPayLoad
    >({
        mutationFn: request,
        ...options,
    });
};
