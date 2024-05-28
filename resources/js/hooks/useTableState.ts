import { PaginationState, SortingState } from '@tanstack/react-table';
import { useCallback, useMemo, useState } from 'react';

type Props = {
  pageSize?: number;
};

export const useTableState = (params: Props = {}) => {
  const [{ pageIndex, pageSize }, setPagination] = useState<PaginationState>({
    pageIndex: 0,
    pageSize: params?.pageSize || 10,
  });
  const [sortingState, setSortingState] = useState<SortingState>([]);
  const { id: sortBy, desc } = sortingState?.[0] || {};

  const getPagination = useCallback(
    (pageCount?: number) => ({
      count: pageCount ?? -1,
      pageIndex,
      pageSize,
      onPaginationChange: setPagination,
    }),
    [pageIndex, pageSize]
  );

  const sorting = useMemo(
    () => ({
      sortingState,
      onSortingChange: setSortingState,
    }),
    [sortingState]
  );

  return {
    sorting,
    getPagination,
    page: pageIndex + 1,
    pageSize,
    sortBy,
    desc,
  };
};
