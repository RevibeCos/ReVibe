import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { ReactElement, ReactNode, Children, isValidElement } from 'react';

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}

export const hasChildren = (
  element: ReactNode
): element is ReactElement<{ children: ReactNode | ReactNode[] }> =>
  isValidElement<{ children?: ReactNode[] }>(element) &&
  Boolean(element.props.children);

export const childToString = (child?: ReactNode): string => {
  if (
    typeof child === 'undefined' ||
    child === null ||
    typeof child === 'boolean'
  ) {
    return '';
  }

  if (JSON.stringify(child) === '{}') {
    return '';
  }

  return (child as number | string).toString();
};

export const onlyText = (children: ReactNode | ReactNode[]): string => {
  if (!(children instanceof Array) && !isValidElement(children)) {
    return childToString(children);
  }

  return Children.toArray(children).reduce(
    (text: string, child: ReactNode): string => {
      let newText = '';

      if (hasChildren(child)) {
        newText = onlyText(child.props.children);
      } else if (isValidElement(child)) {
        newText = '';
      } else {
        newText = childToString(child);
      }

      return text.concat(newText);
    },
    ''
  );
};

export function getDirtyValues<
  DirtyFields extends Record<string, unknown>,
  Values extends Partial<Record<keyof DirtyFields, unknown>>
>(dirtyFields: DirtyFields, values: Values): Partial<typeof values> {
  const dirtyValues = Object.keys(dirtyFields).reduce((prev, key) => {
    if (!dirtyFields[key]) return prev;

    return {
      ...prev,
      [key]:
        typeof dirtyFields[key] === 'object'
          ? getDirtyValues(
              dirtyFields[key] as DirtyFields,
              values[key] as Values
            )
          : values[key],
    };
  }, {});

  return dirtyValues;
}
