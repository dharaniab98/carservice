import { TestBed } from '@angular/core/testing';

import { LoginsService } from './logins.service';

describe('LoginsService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: LoginsService = TestBed.get(LoginsService);
    expect(service).toBeTruthy();
  });
});
