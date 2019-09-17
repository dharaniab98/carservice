import { TestBed } from '@angular/core/testing';

import { ResetsService } from './resets.service';

describe('ResetsService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ResetsService = TestBed.get(ResetsService);
    expect(service).toBeTruthy();
  });
});
